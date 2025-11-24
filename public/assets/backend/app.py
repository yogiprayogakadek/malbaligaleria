import os
import re
import requests
from urllib.parse import urlparse

# 💾 Lokasi file CSS
CSS_FILE = "./css/styles.css"  # cukup tulis nama file atau path relatif

# 📂 Folder tempat menyimpan hasil download
OUTPUT_DIR = "output"

# 🔍 Baca isi file CSS
with open(CSS_FILE, "r", encoding="utf-8") as f:
    css_content = f.read()

# 🎯 Temukan semua URL dari file CSS
urls = re.findall(r'url\((?:["\']?)(https?://[^)"\']+)(?:["\']?)\)', css_content)
print(f"🎯 Ditemukan {len(urls)} file di {CSS_FILE}\n")

# 🧠 Hapus duplikat
urls = list(set(urls))

for url in urls:
    try:
        # Pisahkan path dari URL
        parsed = urlparse(url)
        path = parsed.path.lstrip("/")
        local_path = os.path.join(OUTPUT_DIR, path)

        # Pastikan folder tujuan ada
        os.makedirs(os.path.dirname(local_path), exist_ok=True)

        # Download file
        response = requests.get(url, timeout=15)
        if response.status_code == 200:
            with open(local_path, "wb") as f:
                f.write(response.content)
            print(f"✅ {url} -> {local_path}")
        else:
            print(f"⚠️ Gagal ({response.status_code}): {url}")

    except Exception as e:
        print(f"❌ Error: {url}\n   {e}")

print("\n🎉 Semua file selesai diproses!")
