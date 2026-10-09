import pyamf

with open('server/config/game/sys_config/goods.jat', 'rb') as f:
    items = next(pyamf.decode(f.read()))[0]

test_items = ['tz0901', 'tz0902', 'sz0001', 'exppill_005', '120jianding1', 'baoshihuodong4']
for it in items:
    gid = it.get('id')
    if gid in test_items:
        print(f"ID: {gid} | Name: {it.get('name')} | Category: {it.get('category')} | LevelReq: {it.get('levelreq')} | RareLevel: {it.get('rarelevel')}")
        # print non-empty fields
        non_empty = {k: v for k, v in it.items() if v not in ('', None, 0, '0')}
        print("  Non-empty fields:", non_empty)
