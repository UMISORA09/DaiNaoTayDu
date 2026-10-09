import struct

with open('GiftCodeServiceImpl.class', 'wb') as out_f:
    import zipfile
    with zipfile.ZipFile('server/dntg_start.jar', 'r') as z:
        out_f.write(z.read('com/xianling/bus/giftcode/service/impl/GiftCodeServiceImpl.class'))

with open('GiftCodeServiceImpl.class', 'rb') as f:
    data = f.read()

magic, minor, major, cp_count = struct.unpack('>IHHH', data[:10])
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
    if idx == 0 or idx >= len(cp) or cp[idx] is None:
        return ""
    item = cp[idx]
    if isinstance(item, tuple):
        if item[0] == 'ref':
            return resolve(item[1])
        elif item[0] == 'ref2':
            return f"{resolve(item[1])}.{resolve(item[2])}"
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
    print(f"\nMethod: {name} {desc}")
    for _ in range(attrs_count):
        attr_name_idx, attr_len = struct.unpack('>HI', data[pos:pos+6])
        pos += 6
        attr_name = resolve(attr_name_idx)
        if attr_name == 'Code':
            max_stack, max_locals, code_len = struct.unpack('>HHI', data[pos:pos+8])
            code = data[pos+8:pos+8+code_len]
            # print disassembled instructions
            idx = 0
            while idx < code_len:
                op = code[idx]
                # print constant references if any
                line = f"  {idx:3d}: op={op}"
                if op in (18,): # ldc
                    c_idx = code[idx+1]
                    line += f" ldc [{resolve(c_idx)}]"
                    idx += 2
                elif op in (19, 20): # ldc_w
                    c_idx = struct.unpack('>H', code[idx+1:idx+3])[0]
                    line += f" ldc_w [{resolve(c_idx)}]"
                    idx += 3
                elif op in (180, 181): # getfield, putfield
                    c_idx = struct.unpack('>H', code[idx+1:idx+3])[0]
                    line += f" field [{resolve(c_idx)}]"
                    idx += 3
                elif op in (182, 183, 184, 185): # invokevirtual, special, static, interface
                    c_idx = struct.unpack('>H', code[idx+1:idx+3])[0]
                    line += f" invoke [{resolve(c_idx)}]"
                    idx += 3 if op != 185 else 5
                else:
                    idx += 1
                if any(k in line for k in ['invoke', 'ldc', 'field']):
                    print(line)
        pos += attr_len
