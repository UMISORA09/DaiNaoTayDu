# -*- coding: utf-8 -*-
import zlib, pyamf, os

# 1. Compare maps.dat entries
maps_obj = list(pyamf.decode(zlib.decompress(open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat', 'rb').read(), -15)))[0]
for mid in ['107', '115', '117', '120']:
    m = maps_obj.get(mid)
    print(f"\n--- maps.dat for Map {mid} ---")
    if m:
        for k in sorted(m.keys()):
            if k not in ['bytes', 'monsterList']:
                print(f"  {k}: {m[k]}")
            elif k == 'monsterList':
                print(f"  monsterList: count={len(m[k])}, sample={m[k][:2] if m[k] else []}")
    else:
        print("  NOT FOUND!")

# 2. Compare server map_config files
for mid in ['107', '115', '117', '120']:
    p = os.path.join(r'D:\server\server\config\game\map_config', mid)
    print(f"\n--- Server map_config for Map {mid} ---")
    if os.path.exists(p):
        for f in os.listdir(p):
            fp = os.path.join(p, f)
            print(f"  {f}: size={os.path.getsize(fp)}")
