# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\chn.dat'
t = list(pyamf.decode(zlib.decompress(open(p, 'rb').read(), -15)))[0]
d = t[0]

keywords = ["驻守地图", "镇元子", "红孩儿", "神将", "降龙罗汉", "多宝道人", "乾坤魔神", "千手观音", "雷公", "孟婆"]
for k, v in d.items():
    if any(w in str(k) or w in str(v) for w in keywords):
        print(f"KEY: {k}  =>  VAL: {v}")
