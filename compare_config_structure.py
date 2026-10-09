import zlib, pyamf

p1 = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat.bak_allday'
p2 = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'

r1 = open(p1, 'rb').read()
r2 = open(p2, 'rb').read()

d1 = zlib.decompress(r1, -15)
d2 = zlib.decompress(r2, -15)

o1 = list(pyamf.decode(d1))[0]
o2 = list(pyamf.decode(d2))[0]

print("Keys o1 == keys o2?", set(o1.keys()) == set(o2.keys()))
print("Diff keys in o1:", set(o1.keys()) - set(o2.keys()))
print("Diff keys in o2:", set(o2.keys()) - set(o1.keys()))

# Check type of values for each key
type_diffs = []
for k in o1:
    v1 = o1[k]
    v2 = o2.get(k)
    t1 = type(v1)
    t2 = type(v2)
    if t1 != t2:
        type_diffs.append((k, t1, t2))

print("Type diffs count:", len(type_diffs))
for td in type_diffs:
    print(" ", td)
