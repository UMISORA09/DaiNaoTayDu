import zipfile

with open('GiftCodeServiceImpl.class', 'rb') as f:
    data = f.read()

# Let's inspect strings with offsets in the class
import re
print("Looking for libao_check.do in class...")
idx = data.find(b'libao_check.do')
if idx != -1:
    print(f"Found libao_check at offset {idx}")
    # print surrounding bytes
    start = max(0, idx - 100)
    end = min(len(data), idx + 200)
    print("Context:", data[start:end])

# Also check PublicGiftConfig
with zipfile.ZipFile('server/dntg_start.jar', 'r') as z:
    for n in z.namelist():
        if 'PublicGiftConfig' in n:
            print("Found:", n)
            pdata = z.read(n)
            strs = re.findall(b'[\x20-\x7e]{3,}', pdata)
            print("PublicGiftConfig strings:", [s.decode('latin1') for s in strs])
