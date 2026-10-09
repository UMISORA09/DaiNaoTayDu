import zipfile, re

with zipfile.ZipFile('server/dntg_start.jar', 'r') as z:
    for n in z.namelist():
        if 'Equip' in n and 'Config' in n:
            print(n)
