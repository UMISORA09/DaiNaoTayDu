# -*- coding: utf-8 -*-
import zipfile, re

with zipfile.ZipFile(r'D:\server\server\dntg_start.jar') as z:
    content = z.read('com/xianling/stage/configure/export/impl/BossTiaoZhanConfigExportServiceImpl.class')
    # find all strings
    strings = re.findall(rb'[\x20-\x7e]{4,}', content)
    for s in strings:
        if any(w in s for w in [b'Boss', b'boss', b'dat', b'jat', b'config', b'sys']):
            print("String in class:", s)
