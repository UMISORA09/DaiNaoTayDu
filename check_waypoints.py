import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
key7 = list(pyamf.decode(bytes(obj.get('7'))))[0]

wayPoint = key7.get('wayPoint', {})
print("--- Waypoints for maps 107, 115, 117, 120 ---")
for k, v in wayPoint.items():
    m = v.get('map')
    tm = v.get('toMap')
    if any(x in [m, tm] for x in ['107', '115', '117', '120']):
        print(f"{k}: map {m} ({v.get('x')}, {v.get('y')}) -> toMap {tm} ({v.get('toX')}, {v.get('toY')}) | toWayPointID={v.get('toWayPointID')} | limit={v.get('limit')}")
