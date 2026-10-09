# -*- coding: utf-8 -*-
import sys
sys.path.append(r'D:\server\GPHWEB\wwwroot')
import parse_b1

abc_data = parse_b1.abc_data
strings = parse_b1.strings
multinames = parse_b1.multinames

# Find method body of de:
# starts around 208, 48, 36, 0, 99, 5...
start_idx = abc_data.find(bytes([208, 48, 36, 0, 99, 5]))
print("Found method body start at:", start_idx)

# Let's decode AVM2 instructions
OPCODES = {
    0x02: 'nop', 0x03: 'throw', 0x08: 'kill', 0x09: 'label',
    0x10: 'jump', 0x11: 'iftrue', 0x12: 'iffalse', 0x13: 'ifeq', 0x14: 'ifne',
    0x15: 'iflt', 0x16: 'ifle', 0x17: 'ifgt', 0x18: 'ifge',
    0x20: 'pushnull', 0x21: 'pushundefined', 0x24: 'pushbyte', 0x25: 'pushshort',
    0x26: 'pushtrue', 0x27: 'pushfalse', 0x28: 'pushnan', 0x2a: 'dup', 0x29: 'pop',
    0x2c: 'pushstring', 0x2d: 'pushint', 0x2e: 'pushuint', 0x2f: 'pushdouble',
    0x30: 'pushscope', 0x31: 'popscope',
    0x40: 'newfunction', 0x41: 'call', 0x42: 'construct', 0x43: 'callmethod',
    0x44: 'callstatic', 0x45: 'callsuper', 0x46: 'callproperty', 0x47: 'returnvoid',
    0x48: 'returnvalue', 0x49: 'constructsuper', 0x4a: 'constructprop',
    0x4c: 'callproplex', 0x4e: 'callsupervoid', 0x4f: 'callpropvoid',
    0x5d: 'findpropstrict', 0x5e: 'findproperty',
    0x60: 'getlex', 0x61: 'setproperty', 0x62: 'getlocal', 0x63: 'setlocal',
    0x66: 'getproperty', 0x68: 'initproperty',
    0x70: 'convert_s', 0x73: 'convert_i', 0x74: 'convert_u', 0x75: 'convert_d',
    0x76: 'convert_b', 0x77: 'convert_o',
    0x80: 'coerce', 0x82: 'coerce_a', 0x85: 'coerce_s',
    0x90: 'negate', 0x91: 'increment', 0x92: 'inc_local', 0x93: 'decrement',
    0x94: 'dec_local', 0x96: 'not', 0xa0: 'add', 0xa1: 'subtract',
    0xa2: 'multiply', 0xa3: 'bitxor', 0xa4: 'bitand', 0xa5: 'bitor',
    0xa6: 'bitand', 0xa7: 'bitnot', 0xa8: 'equals', 0xa9: 'strictequals',
    0xaa: 'lessthan', 0xab: 'lessequals', 0xac: 'greaterthan', 0xad: 'greaterequals',
    0xc0: 'inclocal_i', 0xc1: 'declocal_i', 0xc2: 'increment_i', 0xc3: 'decrement_i',
    0xd0: 'getlocal_0', 0xd1: 'getlocal_1', 0xd2: 'getlocal_2', 0xd3: 'getlocal_3',
    0xd4: 'setlocal_0', 0xd5: 'setlocal_1', 0xd6: 'setlocal_2', 0xd7: 'setlocal_3',
    0xef: 'debug', 0xf0: 'debugline', 0xf1: 'debugfile'
}

p = start_idx
end = start_idx + 450
while p < end:
    op = abc_data[p]
    op_name = OPCODES.get(op, f"0x{op:02x}")
    inst_p = p
    p += 1
    args = []
    if op in (0xd0, 0xd1, 0xd2, 0xd3, 0xd4, 0xd5, 0xd6, 0xd7, 0x30, 0x47, 0x48, 0x26, 0x27, 0x20, 0x2a, 0x29, 0xc2, 0xc3, 0xa0, 0xa1, 0xa2, 0xa3, 0xa4, 0xa5, 0xa6, 0xa7, 0xa8, 0xa9, 0x73, 0x74, 0x75, 0x76, 0x02, 0x09):
        pass
    elif op == 0x24: # pushbyte
        b = abc_data[p]
        p += 1
        args.append(str(b))
    elif op == 0x25: # pushshort
        val, p = parse_b1.read_u30(abc_data, p)
        args.append(str(val))
    elif op in (0x62, 0x63, 0x92, 0x94, 0xc0, 0xc1): # local reg
        r, p = parse_b1.read_u30(abc_data, p)
        args.append(f"r{r}")
    elif op in (0x5d, 0x5e, 0x60, 0x61, 0x66, 0x68): # multiname
        mn, p = parse_b1.read_u30(abc_data, p)
        args.append(f"mn[{mn}]={multinames[mn] if mn < len(multinames) else mn}")
    elif op in (0x46, 0x4a, 0x4c, 0x4f): # callprop / constructprop
        mn, p = parse_b1.read_u30(abc_data, p)
        argc, p = parse_b1.read_u30(abc_data, p)
        args.append(f"mn[{mn}]={multinames[mn] if mn < len(multinames) else mn}, argc={argc}")
    elif op in (0x10, 0x11, 0x12, 0x13, 0x14, 0x15, 0x16, 0x17, 0x18): # branch offset s24
        b0 = abc_data[p]
        b1 = abc_data[p+1]
        b2 = abc_data[p+2]
        p += 3
        offset = b0 | (b1 << 8) | (b2 << 16)
        if offset & 0x800000:
            offset -= 0x1000000
        target = p + offset
        args.append(f"target={target} (rel {offset})")
    elif op == 0xef: # debug
        p += 1
        s, p = parse_b1.read_u30(abc_data, p)
        p += 1
        p += 1
        args.append(f"var={strings[s] if s < len(strings) else s}")
    elif op == 0xf0: # debugline
        line, p = parse_b1.read_u30(abc_data, p)
        args.append(f"line {line}")
    elif op == 0xf1: # debugfile
        s, p = parse_b1.read_u30(abc_data, p)
        args.append(f"file={strings[s] if s < len(strings) else s}")
    elif op == 0x80: # coerce
        mn, p = parse_b1.read_u30(abc_data, p)
        args.append(f"mn[{mn}]")
    elif op == 0x2c: # pushstring
        s, p = parse_b1.read_u30(abc_data, p)
        args.append(repr(strings[s]))
    else:
        args.append("...")
    print(f"{inst_p:4d}: {op_name:15s} {' '.join(args)}")
