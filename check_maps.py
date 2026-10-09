# -*- coding: utf-8 -*-
import os, zlib, pyamf

# 1. Check map_config folder in server
maps = ['107', '115', '117', '120']
for m in maps:
    p = os.path.join(r'D:\server\server\config\game\map_config', m)
    print(f"Map folder {m} exists: {os.path.exists(p)}")
    if os.path.exists(p):
        print(f"   contents: {os.listdir(p)}")

# 2. Check Key 7 (map info) in config.dat
cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

val_7 = bytes(obj.get('7'))
key7 = list(pyamf.decode(val_7))[0]
print("Key 7 keys:", list(key7.keys()))
# Inspect wayPoint, npcTeleport, fx
for subk in ['wayPoint', 'npcTeleport', 'fx']:
    if subk in key7:
        val = key7[subk]
        print(f"key7['{subk}'] type: {type(val)}, length: {len(val) if hasattr(val, '__len__') else 'N/A'}")
        if isinstance(val, dict):
            print(f"   some keys: {list(val.keys())[:15]}")
            for m in maps:
                print(f"   contains '{m}'? {m in val}")

