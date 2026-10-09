# -*- coding: utf-8 -*-
import os, struct

def find_best_spot(mid, x0, y0):
    p = os.path.join(r'D:\server\server\config\game\map_config', mid, 'path.mm')
    raw = open(p, 'rb').read()
    w, h = struct.unpack('>II', raw[:8])
    grid = raw[8:]
    print(f"\nEvaluating spots on Map {mid} near ({x0}, {y0}) [w={w}, h={h}]:")
    # We want a walkable cell that has at least 8 walkable neighbors (open area)
    candidates = []
    for r in range(0, 25):
        for dy in range(-r, r+1):
            for dx in range(-r, r+1):
                x = x0 + dx
                y = y0 + dy
                if 2 <= x < w-2 and 2 <= y < h-2:
                    if grid[y * w + x] == 0:
                        # count walkable neighbors in 3x3
                        walkable_neighbors = sum(1 for ny in range(y-1, y+2) for nx in range(x-1, x+2) if grid[ny * w + nx] == 0)
                        if walkable_neighbors >= 8:
                            dist = (dx*dx + dy*dy)**0.5
                            candidates.append((dist, x, y, walkable_neighbors))
        if len(candidates) >= 5:
            break
    candidates.sort()
    for c in candidates[:5]:
        print(f"  Candidate ({c[1]}, {c[2]}): dist={c[0]:.1f}, open={c[3]}/9")
    return candidates[0][1], candidates[0][2] if candidates else (x0, y0)

find_best_spot('115', 58, 12)
find_best_spot('115', 7, 59)
find_best_spot('117', 17, 24)
find_best_spot('117', 36, 151)
find_best_spot('120', 101, 8)
find_best_spot('120', 109, 138)
