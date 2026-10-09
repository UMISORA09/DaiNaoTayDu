import zlib, pyamf, os

bak_files = [f for f in os.listdir(r'D:\server\GPHWEB\wwwroot\res\config\zhcn') if 'maps.dat.bak' in f]
print("Maps backup files:", bak_files)

p1 = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat.bak_allday' if 'maps.dat.bak_allday' in bak_files else os.path.join(r'D:\server\GPHWEB\wwwroot\res\config\zhcn', bak_files[0])
p2 = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat'

r1 = open(p1, 'rb').read()
r2 = open(p2, 'rb').read()

d1 = zlib.decompress(r1, -15)
d2 = zlib.decompress(r2, -15)

o1 = list(pyamf.decode(d1))[0]
o2 = list(pyamf.decode(d2))[0]

print("Keys o1 == keys o2?", set(o1.keys()) == set(o2.keys()))
for k in o1:
    v1 = o1[k]
    v2 = o2.get(k)
    if v1 != v2:
        print(f"Diff in map {k}:")
        for f in set(v1.keys()) | set(v2.keys()):
            if v1.get(f) != v2.get(f):
                print(f"  Field {f}: o1={v1.get(f)} vs o2={v2.get(f)}")
