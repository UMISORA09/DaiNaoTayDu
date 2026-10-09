# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

for k in ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '14', '15', '16', '19', 'bs']:
    if k in obj:
        val = obj[k]
        try:
            b = bytes(val)
            decoded = list(pyamf.decode(b))[0]
            if isinstance(decoded, list) and len(decoded) > 0:
                sample = decoded[0]
                print(f"Key '{k}': {len(decoded)} items. Sample: {list(sample.keys()) if isinstance(sample, dict) else type(sample)}")
                if isinstance(sample, dict):
                    print(f"    id={sample.get('id')}, name={sample.get('name')}, level={sample.get('level')}")
            elif isinstance(decoded, dict):
                print(f"Key '{k}': dict with keys {list(decoded.keys())[:10]}")
        except Exception as e:
            print(f"Key '{k}' error: {e}")
