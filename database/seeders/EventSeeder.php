<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // NON-REGULAR EVENTS — campuran: sudah lewat, ongoing, upcoming
        // =====================================================
        $today = now()->toDateString(); // 2026-02-26

        $nonRegularEvents = [
            // ----- ENDED (sudah lewat) -----
            [
                'name'            => 'Bali Beauty Expo 2026',
                'start_date'      => '2026-01-10',
                'end_date'        => '2026-01-15',
                'start_time'      => '10:00:00',
                'end_time'        => '21:00:00',
                'description'     => 'Pameran kecantikan terbesar di Bali menghadirkan ratusan brand lokal dan internasional. Dapatkan demo produk gratis, konsultasi kecantikan, dan penawaran eksklusif.',
                'location'        => 'Main Atrium',
                'organizer'       => 'Beauty Bali Collective',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Demo Produk, Beauty Talk',
                'is_active'       => true,
            ],
            [
                'name'            => 'Valentine\'s Romantic Dinner',
                'start_date'      => '2026-02-14',
                'end_date'        => '2026-02-14',
                'start_time'      => '18:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Rayakan hari kasih sayang bersama orang terkasih dengan makan malam romantis, hiburan live jazz, dan dekorasi spesial Valentine di Garden Area.',
                'location'        => 'Garden Area',
                'organizer'       => 'Events Team MBG',
                'is_paid'         => true,
                'price'           => 350000.00,
                'target_audience' => 'Adults',
                'highlights'      => 'Romantic Dinner, Live Jazz',
                'is_active'       => true,
            ],
            [
                'name'            => 'Lunar New Year 2026',
                'start_date'      => '2026-01-29',
                'end_date'        => '2026-02-05',
                'start_time'      => '10:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Sambut Tahun Baru Imlek dengan pertunjukan barongsai spektakuler, hiasan lampion cantik, kuliner khas oriental, dan penawaran spesial dari tenant pilihan.',
                'location'        => 'Central Plaza',
                'organizer'       => 'Mal Bali Galeria',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'Family',
                'highlights'      => 'Barongsai, Lampion Festival',
                'is_active'       => true,
            ],
            [
                'name'            => 'MBG Anniversary Sale',
                'start_date'      => '2026-01-05',
                'end_date'        => '2026-01-20',
                'start_time'      => '10:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Rayakan ulang tahun Mal Bali Galeria! Diskon besar-besaran hingga 70% di ratusan tenant, flash sale setiap jam, dan hadiah menarik untuk pengunjung setia.',
                'location'        => 'Mall Wide',
                'organizer'       => 'Mal Bali Galeria',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Diskon 70%, Flash Sale Tiap Jam',
                'is_active'       => true,
            ],

            // ----- ONGOING (berlangsung sekarang) -----
            [
                'name'            => 'Bali Art & Craft Market',
                'start_date'      => '2026-02-20',
                'end_date'        => '2026-03-05',
                'start_time'      => '10:00:00',
                'end_time'        => '21:00:00',
                'description'     => 'Temukan kerajinan tangan, lukisan, dan produk seni lokal Bali yang unik dari para pengrajin berbakat. Kesempatan emas mendukung UMKM lokal sambil berbelanja oleh-oleh berkualitas.',
                'location'        => 'East Wing',
                'organizer'       => 'Bali Craft Association',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Local Crafts, Art Exhibition',
                'is_active'       => true,
            ],
            [
                'name'            => 'Food Festival by the Sea',
                'start_date'      => '2026-02-22',
                'end_date'        => '2026-03-01',
                'start_time'      => '11:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Festival kuliner tematik menghadirkan 50+ booth makanan dari berbagai penjuru Nusantara dan mancanegara. Nikmati sensasi makan sambil diiringi musik akustik setiap sore.',
                'location'        => 'Outdoor Plaza',
                'organizer'       => 'Foodie Bali Co.',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'Family',
                'highlights'      => '50+ Booth Kuliner, Live Acoustic',
                'is_active'       => true,
            ],

            // ----- UPCOMING (akan datang) -----
            [
                'name'            => 'Kids Fun Festival 2026',
                'start_date'      => '2026-03-15',
                'end_date'        => '2026-03-22',
                'start_time'      => '11:00:00',
                'end_time'        => '19:00:00',
                'description'     => 'Festival seminggu penuh khusus untuk anak-anak! Face painting, pertunjukan sulap, balon art, wahana mini, dan workshop seru yang dijamin bikin si kecil tidak mau pulang.',
                'location'        => 'Kids Zone, Level 2',
                'organizer'       => 'Kids World MBG',
                'is_paid'         => true,
                'price'           => 50000.00,
                'target_audience' => 'Kids',
                'highlights'      => 'Magic Show, Face Painting, Mini Rides',
                'is_active'       => true,
            ],
            [
                'name'            => 'Bali Fashion Forward 2026',
                'start_date'      => '2026-04-10',
                'end_date'        => '2026-04-17',
                'start_time'      => '14:00:00',
                'end_time'        => '21:00:00',
                'description'     => 'Runway show bergaya internasional, styling workshop bersama fashion influencer ternama, dan preview koleksi terbaru dari brand-brand lokal terpilih hadir di MBG.',
                'location'        => 'Main Atrium',
                'organizer'       => 'Fashion Forward Bali',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Runway Show, Styling Workshop',
                'is_active'       => true,
            ],
            [
                'name'            => 'Summer Night Concert',
                'start_date'      => '2026-06-20',
                'end_date'        => '2026-06-21',
                'start_time'      => '17:00:00',
                'end_time'        => '23:00:00',
                'description'     => 'Dua malam penuh energi bersama artis-artis lokal dan regional terbaik. Nikmati konser outdoor sambil menikmati kuliner dari berbagai food truck di sekitar venue.',
                'location'        => 'Outdoor Arena',
                'organizer'       => 'Sound Check Entertainment',
                'is_paid'         => true,
                'price'           => 200000.00,
                'target_audience' => 'Adults',
                'highlights'      => 'Live Concert, Food Trucks',
                'is_active'       => true,
            ],
            [
                'name'            => 'Hari Kemerdekaan 17 Agustus',
                'start_date'      => '2026-08-16',
                'end_date'        => '2026-08-17',
                'start_time'      => '08:00:00',
                'end_time'        => '21:00:00',
                'description'     => 'Rayakan HUT RI ke-81 bersama seluruh keluarga! Lomba seru tradisional, pertunjukan seni budaya, bazar UMKM, dan hadiah menarik menanti para pemenang.',
                'location'        => 'Main Atrium & East Wing',
                'organizer'       => 'Mal Bali Galeria',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'Family',
                'highlights'      => 'Lomba 17-an, Pertunjukan Budaya',
                'is_active'       => true,
            ],
            [
                'name'            => 'Halloween Night 2026',
                'start_date'      => '2026-10-31',
                'end_date'        => '2026-10-31',
                'start_time'      => '15:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Trick-or-treat mengelilingi mall, kontes kostum Halloween terbaik dengan hadiah jutaan rupiah, rumah hantu interaktif, dan hiasan seram di seluruh penjuru mall.',
                'location'        => 'Mall Wide',
                'organizer'       => 'Spooky Events MBG',
                'is_paid'         => true,
                'price'           => 75000.00,
                'target_audience' => 'Family',
                'highlights'      => 'Costume Contest, Haunted House',
                'is_active'       => true,
            ],
            [
                'name'            => 'Christmas Wonderland 2026',
                'start_date'      => '2026-12-01',
                'end_date'        => '2026-12-26',
                'start_time'      => '10:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Rasakan keajaiban Natal di MBG! Dekorasi spektakuler, foto bersama Santa Claus, pertunjukan Christmas Carol, salju buatan, dan belanja hadiah dengan diskon spesial.',
                'location'        => 'Central Plaza',
                'organizer'       => 'MBG Events',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'Family',
                'highlights'      => 'Santa Visit, Snow Show, Carol',
                'is_active'       => true,
            ],
        ];

        foreach ($nonRegularEvents as $event) {
            Event::create(array_merge($event, [
                'uuid'            => Str::uuid(),
                'is_regular'      => false,
                'recurring_days'  => null,
                'recurring_label' => null,
            ]));
        }

        // =====================================================
        // REGULAR EVENTS — live music band setiap akhir pekan
        // =====================================================
        $regularEvents = [
            [
                'name'            => 'Live Music: Acoustic Sessions',
                'start_date'      => null,
                'end_date'        => null,
                'start_time'      => '19:00:00',
                'end_time'        => '22:00:00',
                'description'     => 'Nikmati sajian musik akustik yang memanjakan telinga setiap Jumat malam. Band-band berbakat dari Bali menghadirkan lagu-lagu hits lokal dan mancanegara dalam suasana santai yang hangat.',
                'location'        => 'Main Atrium, Level 1',
                'organizer'       => 'Mal Bali Galeria Entertainment',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Live Acoustic, Local Artists',
                'is_active'       => true,
                'is_regular'      => true,
                'recurring_days'  => [5],
                'recurring_label' => 'Setiap Jum\'at',
            ],
            [
                'name'            => 'Weekend Live Band Showcase',
                'start_date'      => null,
                'end_date'        => null,
                'start_time'      => '20:00:00',
                'end_time'        => '23:00:00',
                'description'     => 'Energi penuh di akhir pekan! Band-band pilihan tampil membawakan berbagai genre dari pop, jazz, hingga rock dalam pertunjukan yang meriah dan interaktif. Wajib hadir setiap Sabtu dan Minggu!',
                'location'        => 'Main Atrium, Level 1',
                'organizer'       => 'Mal Bali Galeria Entertainment',
                'is_paid'         => false,
                'price'           => null,
                'target_audience' => 'General',
                'highlights'      => 'Live Band, Weekend Vibes',
                'is_active'       => true,
                'is_regular'      => true,
                'recurring_days'  => [6, 0],
                'recurring_label' => 'Setiap Sabtu & Minggu',
            ],
        ];

        foreach ($regularEvents as $event) {
            Event::create(array_merge($event, ['uuid' => Str::uuid()]));
        }
    }
}
