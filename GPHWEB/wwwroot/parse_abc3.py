# -*- coding: utf-8 -*-
import parse_abc2

abc_data = parse_abc2.abc_data
p = parse_abc2.p
read_u30 = parse_abc2.read_u30

# method_count
method_count, p = read_u30(abc_data, p)
methods = []
for _ in range(method_count):
    param_count, p = read_u30(abc_data, p)
    ret_type, p = read_u30(abc_data, p)
    for _ in range(param_count):
        _, p = read_u30(abc_data, p)
    name_idx, p = read_u30(abc_data, p)
    flags = abc_data[p]
    p += 1
    if flags & 0x08: # HAS_OPTIONAL
        opt_count, p = read_u30(abc_data, p)
        for _ in range(opt_count):
            read_u30(abc_data, p)
            p += 1
    if flags & 0x80: # HAS_PARAM_NAMES
        for _ in range(param_count):
            read_u30(abc_data, p)

# metadata
meta_count, p = read_u30(abc_data, p)
for _ in range(meta_count):
    _, p = read_u30(abc_data, p)
    item_count, p = read_u30(abc_data, p)
    for _ in range(item_count):
        read_u30(abc_data, p)
        read_u30(abc_data, p)

# traits helper
def skip_traits(p):
    count, p = read_u30(abc_data, p)
    for _ in range(count):
        _, p = read_u30(abc_data, p) # name
        kind = abc_data[p]
        p += 1
        t_type = kind & 0x0f
        if t_type in (0, 6): # Slot, Const
            read_u30(abc_data, p) # slot_id
            read_u30(abc_data, p) # type_name
            vindex, p = read_u30(abc_data, p)
            if vindex != 0:
                p += 1 # vkind
        elif t_type in (1, 2, 3): # Method, Getter, Setter
            read_u30(abc_data, p) # disp_id
            read_u30(abc_data, p) # method
        elif t_type == 4: # Class
            read_u30(abc_data, p) # slot_id
            read_u30(abc_data, p) # classi
        elif t_type == 5: # Function
            read_u30(abc_data, p) # slot_id
            read_u30(abc_data, p) # function
        if (kind >> 4) & 0x04: # ATTR_Metadata
            m_count, p = read_u30(abc_data, p)
            for _ in range(m_count):
                read_u30(abc_data, p)
    return p

# classes
class_count, p = read_u30(abc_data, p)
for _ in range(class_count):
    read_u30(abc_data, p) # name
    read_u30(abc_data, p) # super_name
    flags = abc_data[p]
    p += 1
    if flags & 0x08: # PROTECTED_NS
        read_u30(abc_data, p)
    intf_count, p = read_u30(abc_data, p)
    for _ in range(intf_count):
        read_u30(abc_data, p)
    read_u30(abc_data, p) # iinit
    p = skip_traits(p)

for _ in range(class_count):
    read_u30(abc_data, p) # cinit
    p = skip_traits(p)

# scripts
script_count, p = read_u30(abc_data, p)
for _ in range(script_count):
    read_u30(abc_data, p) # sinit
    p = skip_traits(p)

# method bodies
body_count, p = read_u30(abc_data, p)
print(f"Total method bodies: {body_count}")
for b_idx in range(body_count):
    m_idx, p = read_u30(abc_data, p)
    max_stack, p = read_u30(abc_data, p)
    local_count, p = read_u30(abc_data, p)
    init_scope_depth, p = read_u30(abc_data, p)
    max_scope_depth, p = read_u30(abc_data, p)
    code_len, p = read_u30(abc_data, p)
    code = abc_data[p:p+code_len]
    p += code_len
    # skip exceptions
    exc_count, p = read_u30(abc_data, p)
    for _ in range(exc_count):
        read_u30(abc_data, p)
        read_u30(abc_data, p)
        read_u30(abc_data, p)
        read_u30(abc_data, p)
        read_u30(abc_data, p)
    p = skip_traits(p)
    
    # Check if code mentions 384 (string idx for tg.swf) or mn[355] (readByte) or mn[329] (writeByte)
    if b'\x2c\x80\x03' in code or b'\x2c\x80\x83' in code or 384 in code:
        print(f"Method body {b_idx} references tg.swf! Code len: {code_len}")
        print("Bytecode:", list(code))
    elif code.count(bytes([163])) > 0 and (355 in code or 357 in code):
        print(f"Method body {b_idx} has XOR and readByte/bytesAvailable! Code len: {code_len}")
        print("Bytecode:", list(code))
