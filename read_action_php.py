with open('GPHWEB/wwwroot/Action.php', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
cases = re.findall(r'case\s+["\']([^"\']+)["\']:', text)
print("Action.php cases:", cases)

for line in text.splitlines():
    if any(k in line.lower() for k in ['code', 'libao', 'gift', 'email', 'mail']):
        print("MATCH:", line)
