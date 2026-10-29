# Builds public/data/wilayah from db/wilayah.sql of https://github.com/cahyadsn/wilayah (MIT).
# Usage: python3 scripts/build_wilayah.py path/to/wilayah.sql public/data/wilayah
import json, re, sys, os
src, out = sys.argv[1], sys.argv[2]
text = open(src, encoding='utf-8').read()
rows = re.findall(r"\('([0-9.]+)','((?:[^']|'')*)'\)", text)
names = {k: v.replace("''", "'") for k, v in rows}
prov = sorted([k for k in names if k.count('.') == 0])
kota = [k for k in names if k.count('.') == 1]
kec = [k for k in names if k.count('.') == 2]
tree = []
for p in prov:
    ks = sorted([k for k in kota if k.startswith(p + '.')], key=lambda k: names[k])
    tree.append({'kode': p, 'nama': names[p], 'kota': [{'kode': k, 'nama': names[k]} for k in ks]})
tree.sort(key=lambda p: p['nama'])
os.makedirs(os.path.join(out, 'kecamatan'), exist_ok=True)
json.dump(tree, open(os.path.join(out, 'provinsi-kota.json'), 'w'), ensure_ascii=False, separators=(',', ':'))
by_kota = {}
for k in kec:
    by_kota.setdefault(k.rsplit('.', 1)[0], []).append(names[k])
for k, lst in by_kota.items():
    json.dump(sorted(lst), open(os.path.join(out, 'kecamatan', k + '.json'), 'w'), ensure_ascii=False, separators=(',', ':'))
print(len(prov), 'provinsi', len(kota), 'kota', len(kec), 'kecamatan', len(by_kota), 'files')
