from inspect_equip_attr import data, cp

import struct
# let's resolve method ref
def get_cp_desc(idx):
    item = cp[idx]
    if isinstance(item, tuple) and item[0] == 'ref':
        return get_cp_desc(item[1])
    elif isinstance(item, tuple) and item[0] == 'ref2':
        return f"{get_cp_desc(item[1])} : {get_cp_desc(item[2])}"
    return str(item)

print("cp[8]:", get_cp_desc(8))
print("cp[3]:", get_cp_desc(3))
print("cp[9]:", get_cp_desc(9))
print("cp[10]:", get_cp_desc(10))
print("cp[11]:", get_cp_desc(11))
