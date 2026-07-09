<?php

namespace Database\Seeders;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeder ini membuat data contoh inventory dengan hierarki parent-child:
     *   - DVR/Switch sebagai parent
     *   - CCTV channel / port device sebagai child
     */
    public function run(): void
    {
        // Pastikan categories ada dulu
        $this->call(InventoryCategorySeeder::class);

        $catCctv      = InventoryCategory::where('name', 'CCTV')->first();
        $catNetwork   = InventoryCategory::where('name', 'Network Devices')->first();
        $catComputer  = InventoryCategory::where('name', 'Computers')->first();
        $catOffice    = InventoryCategory::where('name', 'Office Equipment')->first();
        $catOther     = InventoryCategory::where('name', 'Other Assets')->first();

        // ============================================================
        // 1. DVR CCTV — Parent
        // ============================================================
        $dvr1 = InventoryItem::firstOrCreate(
            ['serial_number' => 'DVR-HIK-16-001'],
            [
                'category_id' => $catCctv?->id,
                'parent_id'   => null,
                'name'        => 'DVR Hikvision 16Ch - Ruang IT',
                'brand'       => 'Hikvision',
                'model'       => 'DS-7216HQHI-K2',
                'location'    => 'Ruang IT',
                'status'      => 'active',
                'quantity'    => 1,
                'specs'       => [
                    'Total Channel'  => '16',
                    'IP Address'     => '192.168.1.100',
                    'HDD Capacity'   => '2 TB',
                    'Recording Mode' => 'Continuous + Motion',
                ],
                'notes' => 'DVR utama untuk area IT dan lobby. Terhubung ke 8 kamera aktif.',
            ]
        );

        $dvr2 = InventoryItem::firstOrCreate(
            ['serial_number' => 'DVR-HIK-8-002'],
            [
                'category_id' => $catCctv?->id,
                'parent_id'   => null,
                'name'        => 'DVR Hikvision 8Ch - Area Parkir',
                'brand'       => 'Hikvision',
                'model'       => 'DS-7208HQHI-K1',
                'location'    => 'Security Room',
                'status'      => 'active',
                'quantity'    => 1,
                'specs'       => [
                    'Total Channel'  => '8',
                    'IP Address'     => '192.168.1.101',
                    'HDD Capacity'   => '1 TB',
                    'Recording Mode' => 'Motion',
                ],
                'notes' => 'DVR untuk area parkir lantai basement dan lantai 1.',
            ]
        );

        // ============================================================
        // 2. CCTV Channels — Child dari DVR 1
        // ============================================================
        $cctvChannels1 = [
            [
                'name'          => 'CCTV Ch 1 - Pintu Masuk Ruang IT',
                'serial_number' => 'CAM-IT-001',
                'model'         => 'Hikvision Dome 2MP',
                'location'      => 'Ruang IT - Pintu Masuk',
                'specs'         => [
                    'Channel Number' => '1',
                    'DVR IP Address' => '192.168.1.100',
                    'Resolution'     => '1080p',
                    'Coverage Area'  => 'Pintu masuk ruang IT',
                    'Jenis Kamera'   => 'Dome Indoor',
                ],
            ],
            [
                'name'          => 'CCTV Ch 2 - Area Server Rack',
                'serial_number' => 'CAM-IT-002',
                'model'         => 'Hikvision Dome 2MP',
                'location'      => 'Ruang IT - Area Server',
                'specs'         => [
                    'Channel Number' => '2',
                    'DVR IP Address' => '192.168.1.100',
                    'Resolution'     => '1080p',
                    'Coverage Area'  => 'Server rack dan area AC',
                    'Jenis Kamera'   => 'Dome Indoor',
                ],
            ],
            [
                'name'          => 'CCTV Ch 3 - Lobby Utama',
                'serial_number' => 'CAM-LOBBY-001',
                'model'         => 'Hikvision Bullet 4MP',
                'location'      => 'Lobby Utama',
                'specs'         => [
                    'Channel Number' => '3',
                    'DVR IP Address' => '192.168.1.100',
                    'Resolution'     => '4MP',
                    'Coverage Area'  => 'Pintu masuk utama dan area resepsionis',
                    'Jenis Kamera'   => 'Bullet Outdoor',
                ],
            ],
            [
                'name'          => 'CCTV Ch 4 - Eskalator Lt 1 ke Lt 2',
                'serial_number' => 'CAM-ESK-001',
                'model'         => 'Hikvision Dome 2MP',
                'location'      => 'Eskalator Lt.1',
                'specs'         => [
                    'Channel Number' => '4',
                    'DVR IP Address' => '192.168.1.100',
                    'Resolution'     => '1080p',
                    'Coverage Area'  => 'Area eskalator naik dari Lt.1 ke Lt.2',
                    'Jenis Kamera'   => 'Dome Indoor',
                ],
            ],
        ];

        foreach ($cctvChannels1 as $cam) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $cam['serial_number']],
                array_merge($cam, [
                    'category_id' => $catCctv?->id,
                    'parent_id'   => $dvr1->id,
                    'brand'       => 'Hikvision',
                    'status'      => 'active',
                    'quantity'    => 1,
                ])
            );
        }

        // ============================================================
        // 3. CCTV Channels — Child dari DVR 2 (Parkir)
        // ============================================================
        $cctvChannels2 = [
            [
                'name'          => 'CCTV Ch 1 - Pintu Masuk Parkir Basement',
                'serial_number' => 'CAM-PARK-001',
                'model'         => 'Hikvision Bullet 4MP',
                'location'      => 'Basement - Pintu Masuk',
                'specs'         => [
                    'Channel Number' => '1',
                    'DVR IP Address' => '192.168.1.101',
                    'Resolution'     => '4MP',
                    'Coverage Area'  => 'Gate masuk kendaraan basement',
                    'Jenis Kamera'   => 'Bullet Outdoor',
                ],
            ],
            [
                'name'          => 'CCTV Ch 2 - Parkir Basement Timur',
                'serial_number' => 'CAM-PARK-002',
                'model'         => 'Hikvision Dome 2MP',
                'location'      => 'Basement - Sisi Timur',
                'specs'         => [
                    'Channel Number' => '2',
                    'DVR IP Address' => '192.168.1.101',
                    'Resolution'     => '1080p',
                    'Coverage Area'  => 'Area parkir sisi timur basement',
                    'Jenis Kamera'   => 'Dome Indoor',
                ],
            ],
        ];

        foreach ($cctvChannels2 as $cam) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $cam['serial_number']],
                array_merge($cam, [
                    'category_id' => $catCctv?->id,
                    'parent_id'   => $dvr2->id,
                    'brand'       => 'Hikvision',
                    'status'      => 'active',
                    'quantity'    => 1,
                ])
            );
        }

        // ============================================================
        // 4. Network — Core Switch (Parent)
        // ============================================================
        $coreSwitch = InventoryItem::firstOrCreate(
            ['serial_number' => 'SW-CISCO-CORE-001'],
            [
                'category_id' => $catNetwork?->id,
                'parent_id'   => null,
                'name'        => 'Core Switch Cisco - Ruang IT',
                'brand'       => 'Cisco',
                'model'       => 'Catalyst 2960-X 48 Port',
                'location'    => 'Ruang IT - Server Rack',
                'status'      => 'active',
                'quantity'    => 1,
                'specs'       => [
                    'Total Port'     => '48',
                    'Uplink'         => '4x SFP+',
                    'IP Address'     => '192.168.1.1',
                    'VLAN Support'   => 'Yes',
                    'PoE'            => 'Yes (PoE+)',
                ],
                'notes' => 'Core switch utama, semua akses switch terhubung ke sini.',
            ]
        );

        // Access Switch (Child dari Core Switch)
        $accessSwitches = [
            [
                'name'          => 'Access Switch Lt.1 - Tenant Zone A',
                'serial_number' => 'SW-TP-LT1-001',
                'model'         => 'TP-Link TL-SG1024',
                'location'      => 'Lt.1 - Panel Zona A',
                'specs'         => [
                    'Total Port'   => '24',
                    'Uplink ke'    => 'Core Switch Cisco',
                    'IP Address'   => '192.168.1.10',
                    'PoE'          => 'No',
                ],
            ],
            [
                'name'          => 'Access Switch Lt.2 - Foodcourt',
                'serial_number' => 'SW-TP-LT2-001',
                'model'         => 'TP-Link TL-SG1016',
                'location'      => 'Lt.2 - Foodcourt Panel',
                'specs'         => [
                    'Total Port'   => '16',
                    'Uplink ke'    => 'Core Switch Cisco',
                    'IP Address'   => '192.168.1.11',
                    'PoE'          => 'No',
                ],
            ],
        ];

        foreach ($accessSwitches as $sw) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $sw['serial_number']],
                array_merge($sw, [
                    'category_id' => $catNetwork?->id,
                    'parent_id'   => $coreSwitch->id,
                    'brand'       => 'TP-Link',
                    'status'      => 'active',
                    'quantity'    => 1,
                    'notes'       => null,
                ])
            );
        }

        // Router / Firewall (standalone, no parent)
        InventoryItem::firstOrCreate(
            ['serial_number' => 'RT-MIKROTIK-001'],
            [
                'category_id' => $catNetwork?->id,
                'parent_id'   => null,
                'name'        => 'Router MikroTik RB4011 - Gateway Utama',
                'brand'       => 'MikroTik',
                'model'       => 'RB4011iGS+RM',
                'location'    => 'Ruang IT - Server Rack',
                'status'      => 'active',
                'quantity'    => 1,
                'specs'       => [
                    'WAN Interface'  => 'SFP+ (1G)',
                    'LAN Interface'  => '10x Gigabit',
                    'IP WAN'         => 'DHCP dari ISP',
                    'IP LAN'         => '192.168.1.1/24',
                    'ISP Provider'   => 'Telkom IndiHome Business',
                    'Bandwidth'      => '100 Mbps',
                ],
                'notes' => 'Router utama. Terhubung ke modem ISP via SFP fiber.',
            ]
        );

        // ============================================================
        // 5. Komputer — Workstation IT (standalone)
        // ============================================================
        $computers = [
            [
                'name'          => 'PC Workstation - Admin IT',
                'serial_number' => 'PC-IT-ADMIN-001',
                'model'         => 'Dell OptiPlex 3080',
                'location'      => 'Ruang IT',
                'specs'         => [
                    'CPU'         => 'Intel Core i5-10500 @ 3.1GHz',
                    'RAM'         => '16 GB DDR4',
                    'Storage'     => '512 GB SSD + 1 TB HDD',
                    'OS'          => 'Windows 11 Pro',
                    'IP Address'  => '192.168.1.20',
                    'MAC Address' => 'A8:93:4A:12:3B:CD',
                ],
                'notes' => 'PC utama admin IT. Dilengkapi monitor 24 inch Dell.',
            ],
            [
                'name'          => 'PC Kasir - Tenant 12 (Lobby)',
                'serial_number' => 'PC-KASIR-012',
                'model'         => 'Lenovo ThinkCentre M70q',
                'location'      => 'Lobby Tenant 12',
                'specs'         => [
                    'CPU'         => 'Intel Core i3-10100T',
                    'RAM'         => '8 GB DDR4',
                    'Storage'     => '256 GB SSD',
                    'OS'          => 'Windows 10 Pro',
                    'IP Address'  => '192.168.2.112',
                    'MAC Address' => 'B4:2E:99:A1:22:FF',
                ],
                'notes' => 'PC kasir untuk tenant nomor 12 area lobby utama.',
            ],
        ];

        foreach ($computers as $pc) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $pc['serial_number']],
                array_merge($pc, [
                    'category_id' => $catComputer?->id,
                    'parent_id'   => null,
                    'brand'       => explode(' ', $pc['model'])[0],
                    'status'      => 'active',
                    'quantity'    => 1,
                ])
            );
        }

        // ============================================================
        // 6. Office Equipment
        // ============================================================
        $officeItems = [
            [
                'name'          => 'Printer Canon PIXMA - Ruang Admin',
                'serial_number' => 'PRN-CANON-001',
                'brand'         => 'Canon',
                'model'         => 'PIXMA G2020',
                'location'      => 'Ruang Admin',
                'status'        => 'active',
                'specs'         => [
                    'Tipe'        => 'Ink Tank All-in-One',
                    'Koneksi'     => 'USB',
                    'IP Address'  => '-',
                ],
            ],
            [
                'name'          => 'Mesin Absensi Fingerprint - Lobby',
                'serial_number' => 'FP-ZKT-001',
                'brand'         => 'ZKTeco',
                'model'         => 'K40',
                'location'      => 'Lobby Karyawan',
                'status'        => 'active',
                'specs'         => [
                    'Kapasitas Fingerprint' => '3000',
                    'IP Address'            => '192.168.1.200',
                    'Koneksi'               => 'LAN / RS485',
                ],
            ],
            [
                'name'          => 'UPS APC 1000VA - Server Rack IT',
                'serial_number' => 'UPS-APC-001',
                'brand'         => 'APC',
                'model'         => 'BX1000M-MS',
                'location'      => 'Ruang IT - Server Rack',
                'status'        => 'active',
                'specs'         => [
                    'Kapasitas'      => '1000 VA / 600 Watt',
                    'Battery'        => '12V 7.2Ah x2',
                    'Output Outlet'  => '8 Outlet',
                    'Runtime (full)' => '±15 menit',
                ],
                'notes' => 'Backup power untuk core switch, router, dan DVR.',
            ],
        ];

        foreach ($officeItems as $item) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $item['serial_number']],
                array_merge($item, [
                    'category_id' => $catOffice?->id,
                    'parent_id'   => null,
                    'quantity'    => 1,
                ])
            );
        }

        // ============================================================
        // 7. Other Assets — APAR
        // ============================================================
        $otherItems = [
            [
                'name'          => 'APAR CO2 5kg - Ruang IT',
                'serial_number' => 'APAR-CO2-IT-001',
                'brand'         => 'Yamato',
                'model'         => 'CO2 5 kg',
                'location'      => 'Ruang IT',
                'status'        => 'active',
                'specs'         => [
                    'Jenis'           => 'CO2',
                    'Kapasitas'       => '5 kg',
                    'Tanggal Isi'     => '2025-01-01',
                    'Tanggal Expired' => '2026-01-01',
                ],
                'notes' => 'Posisi di dekat pintu ruang IT. Cek tekanan setiap 6 bulan.',
            ],
            [
                'name'          => 'APAR Dry Powder 6kg - Lobby',
                'serial_number' => 'APAR-DP-LOBBY-001',
                'brand'         => 'Yamato',
                'model'         => 'Dry Powder 6 kg',
                'location'      => 'Lobby Utama',
                'status'        => 'active',
                'specs'         => [
                    'Jenis'           => 'Dry Powder',
                    'Kapasitas'       => '6 kg',
                    'Tanggal Isi'     => '2025-01-01',
                    'Tanggal Expired' => '2026-01-01',
                ],
            ],
        ];

        foreach ($otherItems as $item) {
            InventoryItem::firstOrCreate(
                ['serial_number' => $item['serial_number']],
                array_merge($item, [
                    'category_id' => $catOther?->id,
                    'parent_id'   => null,
                    'quantity'    => 1,
                ])
            );
        }

        $this->command->info('InventoryItemSeeder: ' . InventoryItem::count() . ' items seeded successfully.');
    }
}
