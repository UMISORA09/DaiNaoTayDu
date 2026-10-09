# -*- coding: utf-8 -*-
import zlib, pyamf, os, shutil, time

# Mapping Vietnamese names for bosses
boss_names = {
    1: "[Thần Tướng] Trấn Nguyên Tử",
    2: "[Thần Tướng] Hồng Hài Nhi",
    3: "[Thần Tướng] Long Thái Tử Ngao Nhuận",
    4: "[Thần Tướng] Vô Sinh Quỷ Mẫu",
    5: "[Thần Tướng] Mạnh Bà",
    6: "[Thần Tướng] Diêm La Vương",
    7: "[Thần Tướng] Lôi Công",
    8: "[Thần Tướng] Di Lặc Phật",
    9: "[Thần Tướng] Ma Hóa Quan Âm",
    10: "[Thần Tướng] Thiên Thủ Quan Âm",
    11: "〖Quỷ Tướng〗 Xá Lợi Phất",
    12: "〖Quỷ Tướng〗 Mục Kiền Liên",
    13: "〖Quỷ Tướng〗 A Nan Đà",
    14: "〖Quỷ Tướng〗 Ưu Ba Ly",
    15: "〖Quỷ Tướng〗 A Na Luật",
    16: "〖Quỷ Tướng〗 Đại Ca Diếp",
    17: "〖Quỷ Tướng〗 Phú Lâu Na",
    18: "〖Quỷ Tướng〗 Ca Chiên Diên",
    19: "〖Quỷ Tướng〗 La Hầu La",
    20: "【Quỷ Tướng】 Tu Bồ Đề",
    21: "【Thập Bát Già Lam】 Mỹ Âm",
    22: "【Thập Bát Già Lam】 Phạn Âm",
    23: "【Thập Bát Già Lam】 Thiên Cổ",
    24: "Liệt Diễm Khuyển",
    25: "Hàn Băng Khuyển",
    26: "Hàn Sương Đô Úy",
    27: "Xích Viêm Tiền Phong",
    28: "Dung Nham Tri Chu",
    29: "Băng Tinh Tri Chu",
    30: "Băng Sơn Mỹ Yêu",
    31: "Hỏa Hải Diễm Ma",
    32: "Băng Sương Chiến Giải",
    33: "Hàn Lưu Ngư Vệ",
    34: "Kim Mao Hỏa Hầu",
    35: "Nham Tương Hỏa Ngưu",
    36: "[Thần Tướng] Lê Sơn Lão Mẫu",
    37: "【Thập Bát Già Lam】 Thán Diệu",
    38: "[Thần Tướng] Hàng Long La Hán",
    39: "【Thập Bát Già Lam】 Thán Mỹ",
    40: "[Thần Tướng] Đa Bảo Đạo Nhân",
    41: "【Thập Bát Già Lam】 Ma Diệu",
    42: "[Thần Tướng] Càn Khôn Ma Thần",
    43: "【Thập Bát Già Lam】 Lôi Âm",
}

# Monster display names for key '1'
monster_names = {
    'B100001': "【Thần Tướng】 Trấn Nguyên Tử[30 cấp]",
    'B100002': "【Thần Tướng】 Hồng Hài Nhi[40 cấp]",
    'B100003': "【Thần Tướng】 Long Thái Tử Ngao Nhuận[50 cấp]",
    'B100004': "【Thần Tướng】 Vô Sinh Quỷ Mẫu[60 cấp]",
    'B100005': "【Thần Tướng】 Mạnh Bà[70 cấp]",
    'B100006': "【Thần Tướng】 Diêm La Vương[80 cấp]",
    'B100007': "【Thần Tướng】 Lôi Công[85 cấp]",
    'B100008': "【Thần Tướng】 Di Lặc Phật[90 cấp]",
    'B100009': "【Thần Tướng】 Ma Hóa Quan Âm[95 cấp]",
    'B100010': "【Thần Tướng】 Thiên Thủ Quan Âm[100 cấp]",
    'B100011': "【Thần Tướng】 Lê Sơn Lão Mẫu[110 cấp]",
    'B100012': "【Thần Tướng】 Hàng Long La Hán[120 cấp]",
    'B100013': "【Thần Tướng】 Đa Bảo Đạo Nhân[130 cấp]",
    'B100014': "【Thần Tướng】 Càn Khôn Ma Thần[140 cấp]",
    'B200001': "〖Quỷ Tướng〗 Xá Lợi Phất[30 cấp]",
    'B200002': "〖Quỷ Tướng〗 Mục Kiền Liên[40 cấp]",
    'B200003': "〖Quỷ Tướng〗 A Nan Đà[50 cấp]",
    'B200004': "〖Quỷ Tướng〗 Ưu Ba Ly[55 cấp]",
    'B200005': "〖Quỷ Tướng〗 A Na Luật[60 cấp]",
    'B200006': "〖Quỷ Tướng〗 Đại Ca Diếp[65 cấp]",
    'B200007': "〖Quỷ Tướng〗 Phú Lâu Na[70 cấp]",
    'B200008': "〖Quỷ Tướng〗 Ca Chiên Diên[75 cấp]",
    'B200009': "〖Quỷ Tướng〗 La Hầu La[80 cấp]",
    'B200010': "【Quỷ Tướng】 Tu Bồ Đề[85 cấp]",
    'B200011': "【Thập Bát Già Lam】 Mỹ Âm[90 cấp]",
    'B200012': "【Thập Bát Già Lam】 Phạn Âm[95 cấp]",
    'B200013': "【Thập Bát Già Lam】 Thiên Cổ[100 cấp]",
    'B200014': "【Thập Bát Già Lam】 Thán Diệu[110 cấp]",
    'B200015': "【Thập Bát Già Lam】 Thán Mỹ[120 cấp]",
    'B200016': "【Thập Bát Già Lam】 Ma Diệu[130 cấp]",
    'B200017': "【Thập Bát Già Lam】 Lôi Âm[140 cấp]",
}

# Optimized walkable coords for bosses 36 to 43
updated_mapids = {
    36: "107|103:11",
    37: "107|90:94",
    38: "115|49:14",
    39: "115|11:56",
    40: "117|10:21",
    41: "117|35:147",
    42: "120|96:5",
    43: "120|116:136",
}

print("=== 1. Updating config.dat ===")
cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
bak_path = cfg_path + f'.bak_{int(time.time())}'
shutil.copy2(cfg_path, bak_path)
print(f"Backed up config.dat to {bak_path}")

raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

# Update 'bs'
bs_items = list(pyamf.decode(bytes(obj.get('bs'))))[0]
for it in bs_items:
    num = it.get('number')
    if num in boss_names:
        it['name'] = boss_names[num]
    if num in updated_mapids:
        it['mapid'] = updated_mapids[num]

obj['bs'] = pyamf.amf3.ByteArray(pyamf.encode(bs_items).getvalue())

# Update key '1' (monsters)
monsters = list(pyamf.decode(bytes(obj['1'])))[0]
updated_m_count = 0
for m in monsters:
    mid = m.get('id')
    if mid in monster_names:
        m['name'] = monster_names[mid]
        updated_m_count += 1
obj['1'] = pyamf.amf3.ByteArray(pyamf.encode(monsters).getvalue())
print(f"Updated {len(bs_items)} bosses in bs, and {updated_m_count} monsters in key '1'")

# Re-encode config.dat
encoded_cfg = pyamf.encode(obj).getvalue()
comp_cfg = zlib.compress(encoded_cfg)[2:-4] # zlib format with header/footer trimmed for -15
# Verify decompression
zlib.decompress(comp_cfg, -15)
with open(cfg_path, 'wb') as f:
    f.write(comp_cfg)
print(f"Successfully saved updated {cfg_path}")


print("\n=== 2. Updating maps.dat (Fix Map 115 width=68) ===")
maps_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat'
shutil.copy2(maps_path, maps_path + f'.bak_{int(time.time())}')
maps_raw = open(maps_path, 'rb').read()
maps_obj = list(pyamf.decode(zlib.decompress(maps_raw, -15)))[0]

if '115' in maps_obj:
    print(f"Old Map 115 width: {maps_obj['115'].get('width')}")
    maps_obj['115']['width'] = 68
    print(f"New Map 115 width: {maps_obj['115'].get('width')}")

encoded_maps = pyamf.encode(maps_obj).getvalue()
comp_maps = zlib.compress(encoded_maps)[2:-4]
zlib.decompress(comp_maps, -15)
with open(maps_path, 'wb') as f:
    f.write(comp_maps)
print(f"Successfully saved updated {maps_path}")


print("\n=== 3. Updating BossTiaoZhan.jat & BossTiaoZhan.dat ===")
# Build full 43 boss list for BossTiaoZhan
bt_targets = [
    r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat',
    r'D:\server\server\config\game\sys_config\BossTiaoZhan.dat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.jat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.dat',
]

# Use the full bs_items as source for BossTiaoZhan
bt_full_list = []
for it in bs_items:
    entry = dict(it)
    entry['finishtime'] = entry.get('finishtime', '')
    entry['starttime'] = entry.get('starttime', '')
    entry['talk'] = entry.get('talk', '')
    entry['url'] = entry.get('url', '')
    entry['icon'] = entry.get('icon', '')
    entry['gonggao'] = entry.get('gonggao', 0)
    entry['type'] = entry.get('type', 0)
    entry['delay'] = entry.get('delay', 300)
    num = entry.get('number')
    if num in boss_names:
        entry['name'] = boss_names[num]
    if num in updated_mapids:
        entry['mapid'] = updated_mapids[num]
    bt_full_list.append(entry)

plain_amf = pyamf.encode(bt_full_list).getvalue()

for p in bt_targets:
    shutil.copy2(p, p + f'.bak_{int(time.time())}')
    with open(p, 'wb') as f:
        f.write(plain_amf)
    print(f"Updated {p} with {len(bt_full_list)} bosses")

print("\n=== ALL UPDATES COMPLETED SUCCESSFULLY ===")
