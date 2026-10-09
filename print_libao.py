import pyamf

with open('server/config/game/sys_config/LiBao.jat', 'rb') as f:
    libao_list = next(pyamf.decode(f.read()))
    print(f"Total LiBao: {len(libao_list)}")
    for lb in libao_list:
        items = [lb.get(f'item{i}') for i in range(1, 11) if lb.get(f'item{i}')]
        print(f"ID: {lb.get('id')} | Name: {lb.get('name')} | Items: {', '.join(items)}")
