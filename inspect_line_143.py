import struct

with open('RoleEmailServiceImpl.class', 'rb') as f:
    data = f.read()

cp_count = struct.unpack('>H', data[8:10])[0]
pos = 10
cp = [None] * cp_count
i = 1
while i < cp_count:
    tag = data[pos]
    pos += 1
    if tag == 1:
        l = struct.unpack('>H', data[pos:pos+2])[0]
        pos += 2
        cp[i] = data[pos:pos+l].decode('utf-8', errors='ignore')
        pos += l
    elif tag in (3, 4):
        pos += 4
    elif tag in (5, 6):
        pos += 8
        i += 1
    elif tag in (7, 8):
        cp[i] = ('ref', struct.unpack('>H', data[pos:pos+2])[0])
        pos += 2
    elif tag in (9, 10, 11, 12):
        cp[i] = ('ref2', struct.unpack('>HH', data[pos:pos+4]))
        pos += 4
    i += 1

def resolve(idx):
    if isinstance(idx, tuple):
        if idx[0] == 'ref':
            return resolve(idx[1])
        elif idx[0] == 'ref2':
            if len(idx) > 2:
                return f"{resolve(idx[1])}.{resolve(idx[2])}"
            return f"{resolve(idx[1])}"
        return str(idx)
    if not isinstance(idx, int) or idx <= 0 or idx >= len(cp) or cp[idx] is None:
        return str(idx)
    item = cp[idx]
    if isinstance(item, tuple):
        return resolve(item)
    return str(item)

access_flags, this_class, super_class, interfaces_count = struct.unpack('>HHHH', data[pos:pos+8])
pos += 8 + interfaces_count * 2
fields_count = struct.unpack('>H', data[pos:pos+2])[0]
pos += 2
for _ in range(fields_count):
    pos += 6
    attrs_count = struct.unpack('>H', data[pos:pos+2])[0]
    pos += 2
    for _ in range(attrs_count):
        attr_len = struct.unpack('>I', data[pos+2:pos+6])[0]
        pos += 6 + attr_len

methods_count = struct.unpack('>H', data[pos:pos+2])[0]
pos += 2
for _ in range(methods_count):
    m_flags, name_idx, desc_idx, attrs_count = struct.unpack('>HHHH', data[pos:pos+8])
    pos += 8
    name = resolve(name_idx)
    desc = resolve(desc_idx)
    for _ in range(attrs_count):
        attr_name_idx, attr_len = struct.unpack('>HI', data[pos:pos+6])
        pos += 6
        attr_name = resolve(attr_name_idx)
        if attr_name == 'Code' and name == 'list':
            max_stack, max_locals, code_len = struct.unpack('>HHI', data[pos:pos+8])
            code = data[pos+8:pos+8+code_len]
            pc = 480
            while pc < min(code_len, 540):
                op = code[pc]
                if op in (18,): # ldc
                    c_idx = code[pc+1]
                    print(f"  {pc:4d}: ldc [{resolve(c_idx)}]")
                    pc += 2
                elif op in (19, 20): # ldc_w
                    c_idx = struct.unpack('>H', code[pc+1:pc+3])[0]
                    print(f"  {pc:4d}: ldc_w [{resolve(c_idx)}]")
                    pc += 3
                elif op in (180, 181): # getfield, putfield
                    c_idx = struct.unpack('>H', code[pc+1:pc+3])[0]
                    print(f"  {pc:4d}: field [{resolve(c_idx)}]")
                    pc += 3
                elif op in (182, 183, 184, 185): # invokevirtual, special, static, interface
                    c_idx = struct.unpack('>H', code[pc+1:pc+3])[0]
                    print(f"  {pc:4d}: invoke [{resolve(c_idx)}]")
                    pc += 3 if op != 185 else 5
                elif op in (25,): # aload
                    print(f"  {pc:4d}: aload {code[pc+1]}")
                    pc += 2
                elif op in (42, 43, 44, 45):
                    print(f"  {pc:4d}: aload_{op-42}")
                    pc += 1
                else:
                    print(f"  {pc:4d}: op={op}")
                    pc += 1
        pos += attr_len
