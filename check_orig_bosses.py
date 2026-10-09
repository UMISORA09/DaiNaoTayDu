import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat.bak_allday'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
bs_items = list(pyamf.decode(bytes(obj.get('bs'))))[0]

for b in bs_items:
    if b.get('number') in [36, 37, 38, 39, 40, 41, 42, 43]:
        print(f"Boss {b.get('number')}: name={b.get('name')}, mapid={b.get('mapid')}, level={b.get('level')}")
