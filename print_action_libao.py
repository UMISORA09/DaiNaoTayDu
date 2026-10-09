with open('GPHWEB/wwwroot/Action.php', 'r', encoding='utf-8', errors='ignore') as f:
    lines = f.readlines()

recording = False
for idx, line in enumerate(lines):
    if 'libao' in line:
        # print range around it
        start = max(0, idx - 5)
        end = min(len(lines), idx + 40)
        for j in range(start, end):
            print(f"{j+1:4d}: {lines[j]}", end='')
        break
