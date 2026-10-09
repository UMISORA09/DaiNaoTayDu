import zipfile, re, struct

with zipfile.ZipFile('server/dntg_start.jar', 'r') as z:
    data = z.read('com/xianling/gamerule/equip/EquipAttributeService.class')

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
        pos += 2
    elif tag in (9, 10, 11, 12):
        pos += 4
    i += 1

def resolve(idx):
    if not isinstance(idx, int) or idx <= 0 or idx >= len(cp) or cp[idx] is None:
        return str(idx)
    return str(cp[idx])

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
        if attr_name == 'Code' and name == 'getEquipBaseAttribute':
            max_stack, max_locals, code_len = struct.unpack('>HHI', data[pos:pos+8])
            code = data[pos+8:pos+8+code_len]
            code_pos = pos + 8 + code_len
            ex_len = struct.unpack('>H', data[code_pos:code_pos+2])[0]
            code_pos += 2 + ex_len * 8
            code_attrs_count = struct.unpack('>H', data[code_pos:code_pos+2])[0]
            code_pos += 2
            for _ in range(code_attrs_count):
                ca_name_idx, ca_len = struct.unpack('>HI', data[code_pos:code_pos+6])
                code_pos += 6
                ca_name = resolve(ca_name_idx)
                if ca_name == 'LineNumberTable':
                    lnt_count = struct.unpack('>H', data[code_pos:code_pos+2])[0]
                    print(f"Method {name} {desc} LineNumberTable:")
                    for k in range(lnt_count):
                        start_pc, line_no = struct.unpack('>HH', data[code_pos+2+k*4:code_pos+6+k*4])
                        print(f"  pc {start_pc:4d} -> line {line_no}")
                code_pos += ca_len
        pos += attr_len
