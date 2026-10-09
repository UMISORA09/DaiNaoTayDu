# -*- coding: utf-8 -*-
import pyamf, copy

path = r'D:\server\server\config\game\sys_config\GuaiWuBiao.jat'
data = open(path, 'rb').read()
obj = list(pyamf.decode(data))[0]

gw_ids = {x.get('id'): x for x in obj}
template = gw_ids.get('B100010') # template from Lv100 boss

new_bosses = [
    {
        'id': 'B100011',
        'name': '[Thần Tướng] Lê Sơn Lão Mẫu [Lv.110]',
        'level': 110,
        'hitpoints': 1600000,
        'mana': 1600000,
        'physicdamage': 13000,
        'physicdefence': 11000,
        'zhanli': 130000,
        'pak': 'JL-guanyin',
        'drop1': '@zhujue100',
        'basicexp': 180000,
        'basicmoney': '10|60000'
    },
    {
        'id': 'B100012',
        'name': '[Thần Tướng] Hàng Long La Hán [Lv.120]',
        'level': 120,
        'hitpoints': 2000000,
        'mana': 2000000,
        'physicdamage': 15000,
        'physicdefence': 13000,
        'zhanli': 150000,
        'pak': 'duorenfb-xianglongluohan',
        'drop1': '@zhujue110',
        'basicexp': 220000,
        'basicmoney': '10|70000'
    },
    {
        'id': 'B100013',
        'name': '[Thần Tướng] Đa Bảo Đạo Nhân [Lv.130]',
        'level': 130,
        'hitpoints': 2500000,
        'mana': 2500000,
        'physicdamage': 17000,
        'physicdefence': 15000,
        'zhanli': 180000,
        'pak': 'BOSS_taiyi',
        'drop1': '@zhujue120',
        'basicexp': 260000,
        'basicmoney': '10|80000'
    },
    {
        'id': 'B100014',
        'name': '[Thần Tướng] Càn Khôn Ma Thần [Lv.140]',
        'level': 140,
        'hitpoints': 3000000,
        'mana': 3000000,
        'physicdamage': 20000,
        'physicdefence': 18000,
        'zhanli': 220000,
        'pak': '1boss1',
        'drop1': '@zhujue130',
        'basicexp': 300000,
        'basicmoney': '10|100000'
    },
]

added = 0
for nb in new_bosses:
    bid = nb['id']
    if bid not in gw_ids:
        entry = copy.deepcopy(template)
        entry.update(nb)
        obj.append(entry)
        gw_ids[bid] = entry
        added += 1
        print(f"Added {bid}: {nb['name']}")

print(f"Added {added} monsters, total in GuaiWuBiao: {len(obj)}")

plain_bytes = pyamf.encode(obj).getvalue()

all_targets = [
    r'D:\server\server\config\game\sys_config\GuaiWuBiao.jat',
    r'D:\server\server\config\game\sys_config\GuaiWuBiao.dat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\GuaiWuBiao.jat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\GuaiWuBiao.dat'
]

for p in all_targets:
    with open(p, 'wb') as f:
        f.write(plain_bytes)
    print(f"Wrote {p}")
