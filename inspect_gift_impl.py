# -*- coding: utf-8 -*-
import zipfile, re

with zipfile.ZipFile(r'D:\server\server\dntg_start.jar') as z:
    for cls in [
        'com/xianling/bus/giftcode/easyaction/GiftAction.class',
        'com/xianling/bus/giftcode/service/impl/GiftCodeServiceImpl.class',
        'com/xianling/bus/giftcode/configure/export/impl/GiftConfigExportServiceImpl.class',
        'com/xianling/bus/giftcode/configure/export/impl/PublicGiftConfigExportServiceImpl.class',
        'com/xianling/bus/giftcode/configure/export/impl/XuLieHaoConfigExportServiceImpl.class',
        'com/xianling/bus/giftcode/util/GiftUtil.class'
    ]:
        content = z.read(cls)
        print(f"\n=== {cls} ===")
        strs = re.findall(rb'[\x20-\x7e]{4,}', content)
        for s in strs:
            s_str = s.decode('ascii', errors='ignore')
            if any(k in s_str.lower() for k in ['sql', 'table', 'gift', 'code', 'select', 'insert', 'config', 'http', 'php', 'url', 'key', 'file', 'jat', 'dat']):
                print("  ", s_str)
