# -*- coding: utf-8 -*-
import pyamf, zlib

# Check monster.dat
m_path = r'D:\server\server\config\game\sys_config\monster.dat'
m_items = list(pyamf.decode(open(m_path, 'rb').read()))[0]
print(f"Total monsters in monster.dat: {len(m_items)}")
for m in m_items:
    mid = m.get('id')
    if str(mid).startswith('B1000') or str(mid).startswith('B2000'):
        print(f"Monster ID: {mid}, Name: {m.get('name')}, Level: {m.get('level')}")

