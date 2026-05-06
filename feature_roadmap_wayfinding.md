# Roadmap: Interactive Mall Wayfinding (Navigasi Rute Tercepat)

Dokumen ini berisi panduan teknis untuk mengimplementasikan fitur navigasi interaktif pada peta Mal Bali Galeria yang sudah ada.

## 1. Konsep Dasar
Mengubah peta statis (gambar) menjadi jaringan navigasi dinamis menggunakan sistem **Graph**. Pengunjung dapat memilih titik awal (misal: Gate A) dan tujuan (Toko X), lalu sistem akan menggambar rute terpendek yang mengikuti koridor mall.

## 2. Komponen Teknis Utama

### A. Jaringan Navigasi (The Graph)
Kita perlu mendefinisikan "jalan" yang bisa dilalui di dalam mall dalam format JSON.
*   **Nodes (Titik):** Koordinat (x, y) di setiap persimpangan, pintu masuk, lift, dan depan setiap toko.
*   **Edges (Jalur):** Garis yang menghubungkan antar Node, lengkap dengan "berat" (jarak piksel) agar sistem tahu jalur mana yang lebih dekat.

### B. Algoritma Pathfinding
Menggunakan algoritma **Dijkstra** atau **A*** dalam JavaScript untuk menghitung rute tercepat dari titik A ke titik B berdasarkan data Graph di atas.

### C. Visualisasi SVG Layer
Menambahkan lapisan `<svg>` transparan di atas gambar peta (`.png`). Jalur navigasi akan digambar menggunakan elemen `<path>` yang dinamis (bisa diberikan animasi garis bergerak untuk kesan lebih premium).

## 3. Langkah Implementasi (Step-by-Step)

1.  **Mapping Data Jalur:** 
    *   Menggunakan tool sederhana untuk mengambil koordinat (x, y) pada gambar peta untuk setiap persimpangan koridor.
    *   Simpan ke dalam file `mall_graph.json`.

2.  **Integrasi JavaScript:**
    *   Tambahkan library pathfinding sederhana atau buat fungsi Dijkstra kustom.
    *   Buat fungsi `calculateRoute(startNodeId, endNodeId)`.

3.  **UI/UX Navigasi:**
    *   Tambahkan tombol "Petunjuk Arah" pada modal detail Tenant.
    *   Tambahkan fitur "Pilih Lokasi Saya" (Gate A, Lobby, atau posisi kustom).
    *   Animasi jalur muncul saat rute ditemukan.

## 4. Keuntungan Fitur
*   **Customer Experience:** Memudahkan pengunjung baru mencari lokasi toko tanpa perlu bertanya ke informasi.
*   **Modernisasi:** Meningkatkan level digital mall ke standar internasional.
*   **Data Insight:** Bisa melacak jalur mana yang paling sering dicari oleh pengunjung (heat map navigasi).

---
*Fitur ini dapat dikembangkan setelah sistem Karir dan Dashboard Admin sudah stabil sepenuhnya.*
