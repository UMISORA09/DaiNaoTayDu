import zipfile, struct

INSN_LEN = {
    0x10: 1, 0x11: 2, 0x12: 1, 0x13: 2, 0x14: 2,
    0x15: 1, 0x16: 1, 0x17: 1, 0x18: 1, 0x19: 1,
    0x36: 1, 0x37: 1, 0x38: 1, 0x39: 1, 0x3a: 1,
    0x84: 2,
    0x99: 2, 0x9a: 2, 0x9b: 2, 0x9c: 2, 0x9d: 2, 0x9e: 2, 0x9f: 2,
    0xa0: 2, 0xa1: 2, 0xa2: 2, 0xa3: 2, 0xa4: 2, 0xa5: 2, 0xa6: 2,
    0xa7: 2, 0xa8: 2, 0xa9: 1,
    0xb2: 2, 0xb3: 2, 0xb4: 2, 0xb5: 2, 0xb6: 2, 0xb7: 2, 0xb8: 2,
    0xb9: 4, 0xba: 4, 0xbb: 2, 0xbc: 1, 0xbd: 2,
    0xc0: 2, 0xc1: 2, 0xc5: 3, 0xc6: 2, 0xc7: 2, 0xc8: 4, 0xc9: 4
}

class Disasm:
    def __init__(self, data):
        self.data = data
        self.pos = 0
        self.magic, self.minor, self.major, self.cp_count = struct.unpack('>IHHH', data[:10])
        self.cp = [None] * self.cp_count
        self.pos = 10
        i = 1
        while i < self.cp_count:
            tag = data[self.pos]
            self.pos += 1
            if tag == 1:
                l, = struct.unpack('>H', data[self.pos:self.pos+2])
                self.pos += 2
                self.cp[i] = (tag, data[self.pos:self.pos+l].decode('utf-8', errors='ignore'))
                self.pos += l
            elif tag in (3, 4):
                self.cp[i] = (tag, struct.unpack('>I', data[self.pos:self.pos+4])[0])
                self.pos += 4
            elif tag in (5, 6):
                self.cp[i] = (tag, struct.unpack('>Q', data[self.pos:self.pos+8])[0])
                self.pos += 8; i += 1
            elif tag in (7, 8):
                self.cp[i] = (tag, struct.unpack('>H', data[self.pos:self.pos+2])[0])
                self.pos += 2
            elif tag in (9, 10, 11, 12):
                self.cp[i] = (tag, struct.unpack('>HH', data[self.pos:self.pos+4]))
                self.pos += 4
            i += 1
        self.pos += 6
        ic, = struct.unpack('>H', data[self.pos:self.pos+2]); self.pos += 2 + ic*2
        fc, = struct.unpack('>H', data[self.pos:self.pos+2]); self.pos += 2
        for _ in range(fc):
            self.pos += 6
            ac, = struct.unpack('>H', data[self.pos:self.pos+2]); self.pos += 2
            for _ in range(ac):
                self.pos += 2; l, = struct.unpack('>I', data[self.pos:self.pos+4]); self.pos += 4 + l
        mc, = struct.unpack('>H', data[self.pos:self.pos+2]); self.pos += 2
        self.methods = {}
        for _ in range(mc):
            af, n_idx, d_idx, ac = struct.unpack('>HHHH', data[self.pos:self.pos+8]); self.pos += 8
            mname = self.cp[n_idx][1]
            for _ in range(ac):
                an_idx, alen = struct.unpack('>HI', data[self.pos:self.pos+6]); self.pos += 6
                aname = self.cp[an_idx][1]
                if aname == 'Code':
                    max_s, max_l, clen = struct.unpack('>HHI', data[self.pos:self.pos+8])
                    code = data[self.pos+8:self.pos+8+clen]
                    self.methods[mname] = code
                self.pos += alen

    def resolve_cp(self, idx):
        if idx >= len(self.cp) or self.cp[idx] is None: return f"#{idx}"
        item = self.cp[idx]
        if item[0] == 1: return item[1]
        if item[0] == 7: return self.resolve_cp(item[1])
        if item[0] == 8: return repr(self.resolve_cp(item[1]))
        if item[0] in (9, 10, 11):
            cls = self.resolve_cp(item[1][0])
            nat = self.cp[item[1][1]]
            n = self.resolve_cp(nat[1][0])
            d = self.resolve_cp(nat[1][1])
            return f'{cls}.{n}:{d}'
        if item[0] == 12:
            return f'{self.resolve_cp(item[1][0])} {self.resolve_cp(item[1][1])}'
        return str(item)

    def print_code(self, mname):
        code = self.methods.get(mname)
        if not code:
            print("No code for", mname)
            return
        p = 0
        while p < len(code):
            pc = p
            op = code[p]
            p += 1
            extra_len = INSN_LEN.get(op, 0)
            args = code[p:p+extra_len]
            p += extra_len
            
            # format output
            desc = f'{pc:4d}: {hex(op)}'
            if op in (0x12,):
                desc += f' ldc {self.resolve_cp(args[0])}'
            elif op in (0x13, 0x14):
                idx, = struct.unpack('>H', args)
                desc += f' ldc {self.resolve_cp(idx)}'
            elif op in (0xb2, 0xb3, 0xb4, 0xb5, 0xb6, 0xb7, 0xb8, 0xbb, 0xc0, 0xc1):
                idx, = struct.unpack('>H', args)
                desc += f' {self.resolve_cp(idx)}'
            elif op == 0xb9:
                idx, = struct.unpack('>H', args[:2])
                desc += f' invokeinterface {self.resolve_cp(idx)}'
            elif op in (0x99, 0x9a, 0x9b, 0x9c, 0x9d, 0x9e, 0x9f, 0xa0, 0xa1, 0xa2, 0xa3, 0xa4, 0xa5, 0xa6, 0xa7, 0xc6, 0xc7):
                offset, = struct.unpack('>h', args)
                desc += f' goto/if -> {pc + offset}'
            elif op == 0x10:
                desc += f' bipush {args[0]}'
            elif op == 0x11:
                val, = struct.unpack('>h', args)
                desc += f' sipush {val}'
            elif op in (0xb0, 0xb1, 0xac):
                desc += ' return'
            print(desc)

with zipfile.ZipFile('d:/server/server/dntg_start.jar') as z:
    d2 = Disasm(z.read('com/xianling/stage/service/impl/RoleBehaviourServiceImpl.class'))
    print('=== applyWayPointTeleport ===')
    d2.print_code('applyWayPointTeleport')
    print('=== teleportLimit ===')
    d2.print_code('teleportLimit')
