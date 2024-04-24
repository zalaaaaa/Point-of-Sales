### Nama: Ihza Nurkhafidh Al-baihaqi <br >Kelas: TI 2H <br> NIM: 2241720165

-   [Praktikum 2](#laporan-praktikum-web-lanjut-pertemuan-2) <br>
-   [Praktikum 3](#laporan-praktikum-web-lanjut-pertemuan-3) <br>
-   [Praktikum 4](#laporan-praktikum-web-lanjut-pertemuan-4) <br>
-   [Praktikum 5](#laporan-praktikum-web-lanjut-pertemuan-5) <br>

<hr>

# Laporan Praktikum Web Lanjut Pertemuan 2

### TUGAS PRAKTIKUM (Point of Sales)

#### 1. Controller

![alt text](/images/p2/image.png)
![alt text](/images/p2/image-1.png)
![alt text](/images/p2/image-2.png)
![alt text](/images/p2/image-3.png)

#### 2. Routes

![alt text](/images/p2/image-4.png)

#### 3. View

![alt text](/images/p2/image-5.png)

#### 4. Result

![alt text](/images/p2/image-6.png)
![alt text](/images/p2/image-7.png)
![alt text](/images/p2/image-8.png)
![alt text](/images/p2/image-9.png)
![alt text](/images/p2/image-10.png)
![alt text](/images/p2/image-11.png)
![alt text](/images/p2/image-12.png)

<br>
<br>
<br>

# Laporan Praktikum Web Lanjut Pertemuan 3

### Membuat file migrasi tanpa relasi

1. Konfigurasi file .env untuk menghubungkan ke DB mySQL

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=PWL_POS
    DB_USERNAME=root
    DB_PASSWORD=
    ```

2. Membuat file migration untukm_level

    ```
    php artisan make:model m_level -m
    ```

    ![alt text](/images/p3/image-1.png)<br>

3. konfigurasi atribute pada m_level

    ```php
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
        * Run the migrations.
        */
        public function up(): void
        {
            Schema::create('m_levels', function (Blueprint $table) {
                $table->id('level_id');
                $table->string('level_kode', 10)->unique();
                $table->string('level_nama', 100);
                $table->timestamps();
            });
        }

        /**
        * Reverse the migrations.
        */
        public function down(): void
        {
            Schema::dropIfExists('m_levels');
        }
    };

    ```

4. setelah itu melakukan perintah ini agar file migrasi tersekusi

    ```
    php artisan migarate
    ```

5. tabel telah terbuat <br>
   ![alt text](/images/p3/image-2.png)

### Membuat file migrasi dengan relasi

1. membuat table m_user

    ```
    php artisan make:model m_user -m
    ```

2. membuat atribute file m_user

    ```php
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
        * Run the migrations.
        */
        public function up(): void
        {
            Schema::create('m_users', function (Blueprint $table) {
                $table->id('user_id');
                $table->unsignedBigInteger('level_id')->index();
                $table->string('username', 20)->unique();
                $table->string('nama', 100);
                $table->string('password',255);
                $table->timestamps();

                $table->foreign('level_id')->references('level_id')->on('m_levels');
            });
        }

        /**
        * Reverse the migrations.
        */
        public function down(): void
        {
            Schema::dropIfExists('m_users');
        }
    };

    ```

3. setelah itu melakukan perintah ini agar file migrasi tersekusi

    ```
    php artisan migarate
    ```

4. membuat migrasi untuk tabel sisanya menggunakan php migrasi
   ![alt text](/images/p3/image-3.png)

5. setelah konfigurasi atribute sehingga tabel yang akan dikeluarkan sepreti gambar berikut
   ![alt text](image.png)

### Membuat file seeder

1. menggunakan command pberikut untuk membuat file seeder
    ```
    php artisan make:seeder LevelSeeder
    ```
2. konfigurasi file LevelSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    use function Laravel\Prompts\table;

    class LevelSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [
                ['level_id' => 1, 'level_kode' => 'ADM', 'level_nama' => 'Administrator'],
                ['level_id' => 2, 'level_kode' => 'MNG', 'level_nama' => 'Manager'],
                ['level_id' => 3, 'level_kode' => 'STF', 'level_nama' => 'Staff/Kasir'],
            ];
            DB::table('m_levels')->insert($data);
            //
        }
    }
    ```

3. Lalu mengirimkan file menggunakan command berikut

    ```
    php artisan db:seed --class=LevelSeeder

    ```

4. hasil setelah data dimasukkan
   ![alt text](/images/p3/image-4.png)

5. membuat file UserSeeder
    ```
    php artisan make:seeder UserSeeder
    ```
6. konfigurasi file UserSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [
                [
                    'user_id' => 1,
                    'level_id' => 1,
                    'username' => 'admin',
                    'nama' => 'Administrator',
                    'password' => Hash::make('12345')
                ],
                [
                    'user_id' => 2,
                    'level_id' => 2,
                    'username' => 'manager',
                    'nama' => 'Manager',
                    'password' => Hash::make('12345')
                ],
                [
                    'user_id' => 3,
                    'level_id' => 3,
                    'username' => 'staff',
                    'nama' => 'Staff/Kasir',
                    'password' => Hash::make('12345')
                ],
            ];

            DB::table('m_users')->insert($data);
        }
    }
    ```

7. Lalu mengirimkan file menggunakan command berikut

    ```
    php artisan db:seed --class=LevelSeeder
    ```

8. hasil setelah data dimasukkan
   ![alt text](/images/p3/image-5.png)

9. membuat file KategoriSeeder
    ```
    php artisan make:seeder KategoriSeeder
    ```
10. Konfigurasi file KategoriSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class KategoriSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [
                ['kategori_id' => 1, 'kategori_kode' => 'KAT001', 'kategori_nama' => 'Elektronik'],
                ['kategori_id' => 2, 'kategori_kode' => 'KAT002', 'kategori_nama' => 'Pakaian'],
                ['kategori_id' => 3, 'kategori_kode' => 'KAT003', 'kategori_nama' => 'Aksesoris'],
                ['kategori_id' => 4, 'kategori_kode' => 'KAT004', 'kategori_nama' => 'Mainan'],
                ['kategori_id' => 5, 'kategori_kode' => 'KAT005', 'kategori_nama' => 'Alat Tulis'],
            ];
            DB::table('m_kategoris')->insert($data);
        }
    }

    ```

11. Lalu mengirimkan file mennggunakan command berikut

    ```
    php artisan db:seed --class=KategoriSeeder
    ```

12. hasil setelah data dimasukkan
    ![alt text](/images/p3/image-6.png)

13. membuat file BarangSeeder
    ```
    php artisan make:seeder BarangSeeder
    ```
14. Konfigurasi file BarangSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class BarangSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [
                ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Laptop', 'harga_beli' => 8000000, 'harga_jual' => 10000000],
                ['barang_id' => 2, 'kategori_id' => 2, 'barang_kode' => 'BRG002', 'barang_nama' => 'Smartphone', 'harga_beli' => 5000000, 'harga_jual' => 7000000],
                ['barang_id' => 3, 'kategori_id' => 1, 'barang_kode' => 'BRG003', 'barang_nama' => 'Printer', 'harga_beli' => 2000000, 'harga_jual' => 3000000],
                ['barang_id' => 4, 'kategori_id' => 3, 'barang_kode' => 'BRG004', 'barang_nama' => 'Mouse', 'harga_beli' => 500000, 'harga_jual' => 800000],
                ['barang_id' => 5, 'kategori_id' => 2, 'barang_kode' => 'BRG005', 'barang_nama' => 'Keyboard', 'harga_beli' => 600000, 'harga_jual' => 900000],
                ['barang_id' => 6, 'kategori_id' => 4, 'barang_kode' => 'BRG006', 'barang_nama' => 'Action Figure', 'harga_beli' => 300000, 'harga_jual' => 500000],
                ['barang_id' => 7, 'kategori_id' => 5, 'barang_kode' => 'BRG007', 'barang_nama' => 'Ballpoint', 'harga_beli' => 5000, 'harga_jual' => 10000],
                ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'BRG008', 'barang_nama' => 'Headset', 'harga_beli' => 200000, 'harga_jual' => 300000],
                ['barang_id' => 9, 'kategori_id' => 1, 'barang_kode' => 'BRG009', 'barang_nama' => 'Monitor', 'harga_beli' => 1500000, 'harga_jual' => 2000000],
                ['barang_id' => 10, 'kategori_id' => 4, 'barang_kode' => 'BRG010', 'barang_nama' => 'Board Game', 'harga_beli' => 1000000, 'harga_jual' => 1500000],
            ];
            DB::table('m_barangs')->insert($data);
        }
    }

    ```

15. Lalu mengirimkan file mennggunakan command berikut

    ```
    php artisan db:seed --class=BarangSeeder
    ```

16. hasil setelah data dimasukkan
    ![alt text](/images/p3/image-7.png)

17. membuat file StokSeeder
    ```
    php artisan make:seeder StokSeeder
    ```
18. Konfigurasi file StokSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Carbon\Carbon;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class StokSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [];
            $barangIds = DB::table('m_barangs')->pluck('barang_id')->all();
            $userIds = DB::table('m_users')->pluck('user_id')->all();
            $currentDate = Carbon::now();

            foreach ($barangIds as $barangId) {
                // Setiap barang memiliki entri stok dengan jumlah random untuk tanggal yang berbeda-beda
                for ($i = 0; $i < 2; $i++) {
                    $stokTanggal = $currentDate->copy()->subDays(rand(1, 30));
                    $data[] = [
                        'barang_id' => $barangId,
                        'user_id' => $userIds[array_rand($userIds)], // Menggunakan array_rand untuk mengambil user id secara acak
                        'stok_tanggal' => $stokTanggal,
                        'stok_jumlah' => rand(0, 50), // Stok jumlah diacak 0-50
                    ];
                }
            }

            DB::table('t_stoks')->insert($data);
        }
    }

    ```

19. Lalu mengirimkan file mennggunakan command berikut
    ```
    php artisan db:seed --class=StokSeeder
    ```
20. hasil setelah data dimasukkan
    ![alt text](/images/p3/image-8.png)

21. membuat file PenjualanSeeder
    ```
    php artisan make:seeder PenjualanSeeder
    ```
22. Konfigurasi file PenjualanSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Carbon\Carbon;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class PenjualanSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [];
            $userIds = DB::table('m_users')->pluck('user_id')->all();
            $currentDate = Carbon::now();
            $namaAsli = ['John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Brown', 'David Martinez', 'Sarah Wilson', 'Robert Taylor', 'Karen Anderson', 'Daniel Clark', 'Lisa Thomas'];

            for ($i = 0; $i < 10; $i++) {
                $data[] = [
                    'user_id' => $userIds[array_rand($userIds)], // Menggunakan array_rand untuk mengambil user id secara acak
                    'pembeli' => $namaAsli[array_rand($namaAsli)], // Menggunakan array_rand untuk mengambil nama asli secara acak
                    'penjualan_kode' => 'PJN' . str_pad($i + 1, 3, '0', STR_PAD_LEFT), // Kode penjualan dengan format PJN001, PJN002, dst.
                    'penjualan_tanggal' => $currentDate->copy()->subDays(rand(1, 30)), // Menggunakan tanggal acak dalam 30 hari terakhir
                ];
            }

            DB::table('t_penjualans')->insert($data);
        }
    }

    ```

23. Lalu mengirimkan file mennggunakan command berikut
    ```
    php artisan db:seed --class=PenjualanSeeder
    ```
24. hasil setelah data dimasukkan
    ![alt text](/images/p3/image-9.png)
25. membuat file PenjualanDetailSeeder
    ```
    php artisan make:seeder PenjualanDetailSeeder
    ```
26. Konfigurasi file PenjualanDetailSeeder

    ```php
    <?php

    namespace Database\Seeders;

    use Carbon\Carbon;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class PenjualanDetailSeeder extends Seeder
    {
        /**
        * Run the database seeds.
        */
        public function run(): void
        {
            $data = [];
            $barangIds = DB::table('m_barangs')->pluck('barang_id')->all(); // Mengasumsikan 10 barang tersedia
            $currentDate = Carbon::now();

            // Iterasi sebanyak 10 kali (sama dengan jumlah transaksi penjualan)
            for ($i = 1; $i <= 10; $i++) {
                // Setiap transaksi penjualan memiliki 3 barang yang dibeli
                for ($j = 1; $j <= 3; $j++) {
                    $data[] = [
                        'penjualan_id' => $i, // ID transaksi penjualan
                        'barang_id' => $barangIds[array_rand($barangIds)], // Barang diambil secara acak
                        'harga' => rand(10, 50) * 1000, // Harga barang acak antara 1000 dan 5000
                        'harga_jumlah' => rand(1, 5), // Jumlah barang acak antara 1 dan 5
                    ];
                }
            }

            DB::table('t_penjualan_details')->insert($data);
        }
    }

    ```

27. Lalu mengirimkan file mennggunakan command berikut
    ```
    php artisan db:seed --class=PenjualanDetailSeeder
    ```
28. hasil setelah data dimasukkan
    ![alt text](/images/p3/image-10.png)

### DB FACADE

1. buat controller untuk m_level dengan command

    ```
    php artisan make:controller LevelController
    ```

2. konfigurasi routing
   ![alt text](/images/p3/image-11.png)

3. konfigurasi controller agar dapat memasukkan data

    ````php
    <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use Illuminate\Routing\Route;
        use Illuminate\Support\Facades\DB;

        class LevelController extends Controller
        {
            public function index() {
                DB::insert('insert into  m_levels(level_kode, level_nama, created_at) values (?,?,?)', ['CUS', 'Pelanggan', now()]);

                return 'insert data baru berhasil';
            }
        }

        ```
    ````

4. hasil ketika mengakses route yang telah dibuat
   ![alt text](/images/p3/image-12.png)
5. modifikasi agar controller dapat mengupdate data

    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Routing\Route;
    use Illuminate\Support\Facades\DB;

    class LevelController extends Controller
    {
        public function index()
        {
            // DB::insert('insert into  m_levels(level_kode, level_nama, created_at) values (?,?,?)', ['CUS', 'Pelanggan', now()]);

            // return 'insert data baru berhasil';

            $row = DB::delete('delete from m_levels where level_kode = ?', ['CUS']);

            return 'Delete data berhasil. Jumlah data yang dihapus ' . $row . 'baris';
        }
    }

    ```

6. hasil
   ![alt text](/images/p3/image-13.png)

7. modifikasi agar dapat menampilkan seluruh data pada tabel m_level

    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Routing\Route;
    use Illuminate\Support\Facades\DB;

    class LevelController extends Controller
    {
        public function index()
        {
            // DB::insert('insert into  m_levels(level_kode, level_nama, created_at) values (?,?,?)', ['CUS', 'Pelanggan', now()]);

            // return 'insert data baru berhasil';

            // $row = DB::delete('delete from m_levels where level_kode = ?', ['CUS']);

            // return 'Delete data berhasil. Jumlah data yang dihapus ' . $row . 'baris';

            $data = DB::select('select * from m_levels');
            return view('level', ['data'=> $data]);
        }
    }

    ```

8. membuat view

    ```html
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1.0"
            />
            <title>Data Level Pengguna</title>
        </head>

        <body>
            <h1>Data Level Pengguna</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Kode Level</th>
                    <th>Nama Level</th>
                </tr>
                @foreach ($data as $d)
                <tr>
                    <td>{{$d->level_id}}</td>
                    <td>{{$d->level_kode}}</td>
                    <td>{{$d->level_nama}}</td>
                </tr>
                @endforeach
            </table>
        </body>
    </html>
    ```

9. akses view <br>
   ![alt text](/images/p3/image-14.png)

### Implementasi Query Builder

1. membuat kategori controller dengan command
    ```
    php artisan make:controller KategoriController
    ```
2. buat routing
   ![alt text](/images/p3/image-15.png)
3. modifikasi file controller

    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class KategoriController extends Controller
    {
        public function index()
        {
            $data = [
                'kategori_kode' => 'SNK',
                'kategori_nama' => 'Snack/Makanan Ringan',
                'created_at' => now()
            ];

            DB::table('m_kategoris')->insert($data);
            return 'insert data baru berhasil';
        }
    }
    ```

4. hasil <br>
   ![alt text](/images/p3/image-16.png)

### Eloquent ORM

1. membuat UserModel menggunakan command
    ```
    php artisan make:model UserModel
    ```
2. konfigurasi file model

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class UserModel extends Model
    {
        use HasFactory;

        protected $table = 'm_users';
        protected $primaryKey = 'user_id';

    }

    ```

3. buat route <br>
   ![alt text](/images/p3/image-17.png)
4. modifikasi file controller

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        public function index()
        {
            // return view('user.profile')
            // ->with('id', $id)
            // ->with('name', $name);

            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }

    ```

5. membuat view user

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Level Pengguna</title>
        </head>

        <body>
            <h1>Data Level Pengguna</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Kode Level</th>
                    <th>Nama Level</th>
                </tr>
                @foreach ($data as $d)
                <tr>
                    <td>{{$d->user_id}}</td>
                    <td>{{$d->username}}</td>
                    <td>{{$d->nama}}</td>
                    <td>{{$d->level_id}}</td>
                </tr>
                @endforeach
            </table>
        </body>

        </html>

    ```

6. hasil <br>
   ![alt text](/images/p3/image-18.png)
7. modifikasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            // return view('user.profile')
            // ->with('id', $id)
            // ->with('name', $name);

            $data = [
                'username' => 'Customer 1',
                'nama' => 'Pelanggan',
                'password' => Hash::make('12345'),
                'level_id' => 4
            ];
            UserModel::insert($data);

            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }

    ```

8. hasil <br>
   ![alt text](/images/p3/image-19.png)
9. modifikasi file model

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            // return view('user.profile')
            // ->with('id', $id)
            // ->with('name', $name);

            // $data = [
            //     'username' => 'Customer 1',
            //     'nama' => 'Pelanggan',
            //     'password' => Hash::make('12345'),
            //     'level_id' => 4
            // ];
            // UserModel::insert($data);

            $data = [
                'nama' => 'Pelanggan Pertama'
            ];
            UserModel::where('username', 'customer-1')->update($data);

            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }
    ```

10. hasil <br>
    ![alt text](/images/p3/image-20.png)

<hr>

### Pertanyaan

1. APP_KEY pada file .env Laravel adalah kunci rahasia yang digunakan untuk mengenkripsi dan mendekripsi data yang disimpan dalam sesi, cookie, dan lainnya. Ini juga digunakan untuk menghasilkan hash yang aman.

2. untuk meng-generate nilai untuk APP_KEY dengan menjalankan perintah php artisan key:generate di terminal. Ini akan membuat nilai acak untuk kunci aplikasi dan menyimpannya di file .env.

3. secara default Laravel memiliki dua file migrasi. File migrasi ini digunakan untuk membuat tabel pengguna dan tabel sesi. Mereka membantu dalam membangun skema database awal untuk aplikasi Laravel.

4. pada file migrasi menghasilkan dua kolom: created_at dan updated_at. Kolom created_at menunjukkan waktu di mana baris data pertama kali dimasukkan ke dalam tabel, sedangkan kolom updated_at menunjukkan waktu terakhir di mana baris data diperbarui.

5. Fungsi $table->id(); pada file migrasi menghasilkan kolom yang bertipe data auto-incrementing big integer. Ini adalah kolom utama yang digunakan sebagai kunci utama tabel.

6. Perbedaan antara menggunakan $table->id(); dan $table->id('level_id'); pada file migrasi adalah bahwa dengan $table->id('level_id');, Anda memberikan nama khusus untuk kolom id. Dengan $table->id(); Laravel akan menggunakan nama default id untuk kolom id.

7. Fungsi ->unique() pada migration digunakan untuk menetapkan kolom yang unik, yaitu tidak ada duplikat nilai yang diizinkan dalam kolom tersebut.

8. Karena kolom level_id pada tabel m_user menggunakan $tabel->unsignedBigInteger('level_id') karena kolom ini adalah kunci asing yang merujuk ke kolom id di tabel m_level. Sedangkan kolom level_id pada tabel m_level menggunakan $tabel->id('level_id') karena ini adalah kolom utama tabel m_level.

9. Tujuan dari class Hash adalah untuk melakukan hashing dari suatu data, seperti password, sebelum disimpan ke dalam database. Kode program Hash::make('1234'); menghasilkan hash dari string '1234', yang kemudian bisa disimpan di database sebagai password yang terenkripsi.

10. Tanda tanya ? pada query builder digunakan sebagai placeholder untuk parameter pada prepared statement. Ini membantu mencegah SQL injection dengan memisahkan data dari instruksi SQL.

11. penulisan kode protected $table = ‘m_user’; bertujuan untuk memberi tahu model bahwa model ini terkait dengan tabel database yang bernama m_user. Sedangkan protected $primaryKey = ‘user_id’; digunakan untuk memberi tahu model bahwa kolom utamanya adalah user_id.

12. Dalam melakukan operasi CRUD ke database, Eloquent ORM umumnya lebih mudah digunakan daripada DB Facade atau Query Builder karena memungkinkan Anda untuk berinteraksi dengan database menggunakan model dan relasi antar model. Eloquent ORM menyediakan sintaks yang lebih dekat dengan bahasa pemrograman, seperti menambahkan atau mengambil data dari database menggunakan model yang sudah ditentukan, tanpa perlu menulis query SQL manual. Namun, pilihan tergantung pada preferensi dan kebutuhan spesifik proyek.

# Laporan Praktikum Web Lanjut Pertemuan 4

### Praktikum 1

1. konfigurasi file UserModel

    ```php
        <?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class UserModel extends Model
        {
            use HasFactory;

            protected $table = 'm_users';
            protected $primaryKey = 'user_id';

            protected $fillable = ['level_id', 'username', 'nama', 'password'];
        }

    ```

2. konfigurasi UserCOntroller

    ```php
    <?php
    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {

            $data = [
                'level_id' => 2,
                'username' => 'manager_dua',
                'nama' => 'Manager 2',
                'password' => Hash::make('12345'),
            ];

            UserModel::create($data);

            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }

    ```

3. hasil <br>
   ![alt text](/images/p4/image.png)

4. konfigurasi file UserModel

    ```php
        <?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class UserModel extends Model
        {
            use HasFactory;

            protected $table = 'm_users';
            protected $primaryKey = 'user_id';

            protected $fillable = ['level_id', 'username', 'nama'];
        }

    ```

5. konfigurasi UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {

            $data = [
                'level_id' => 2,
                'username' => 'manager_tiga',
                'nama' => 'Manager 3',
                'password' => Hash::make('12345'),
            ];

            UserModel::create($data);

            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }
    ```

6. hasil <br>
   ![alt text](/images/p4/image-1.png)<br>
   terjadi error karena password harus diisi

### Praktikum 2.1

1. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {

            $user = UserModel::find(1);
            return view('user', ['data' => $user]);
        }
    }
    ```

2. edit view

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Level Pengguna</title>
    </head>

    <body>
        <h1>Data Level Pengguna</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
                <th>ID Level Pengguna</th>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->user_id}}</td>
                <td>{{$d->username}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->level_id}}</td>
            </tr>
            @endforeach
        </table>
    </body>

    </html>
    ```

3. hasil
   ![alt text](/images/p4/image-2.png)
4. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::where('level_id', 1)->first();
            return view('user', ['data' => $user]);
        }
    }
    ```

5. hasil <br>
   ![alt text](/images/p4/image-3.png)
6. konfigurasi file UserController

    ```php
        <?php

        namespace App\Http\Controllers;

        use App\Models\UserModel;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Hash;

        class UserController extends Controller
        {
            public function index()
            {
                $user = UserModel::where('level_id', 1);
                return view('user', ['data' => $user]);
            }
        }
    ```

7. hasil <br>
   ![alt text](/images/p4/image-4.png)

8.konfigurasi file UserController

```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::findOr(1, ['username', 'nama'], function () {
                abort(404);
            });
            return view('user', ['data' => $user]);
        }
    }

```

9. hasil <br>
   ![alt text](/images/p4/image-5.png)

10. konfigurasi UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::findOr(20, ['username', 'nama'], function () {
                abort(404);
            });
            return view('user', ['data' => $user]);
        }
    }
    ```

11. hasil <br>
    ![alt text](/images/p4/image-6.png)

### Praktikum 2.2

1. konfigurasi UserController

    ```php
        <?php

        namespace App\Http\Controllers;

        use App\Models\UserModel;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Hash;

        class UserController extends Controller
        {
            public function index()
            {
                $user = UserModel::findOrFail(1);
                return view('user', ['data' => $user]);
            }
        }

    ```

2. hasil <br>
   ![alt text](/images/p4/image-7.png) <br>
   mencari data berdasarkan primary key

3. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::where('username', 'manager9')->firstOrFail();
            return view('user', ['data' => $user]);
        }
    }

    ```

4. hasil <br>
   ![alt text](/images/p4/image-8.png)
   data tidak ditemukan

### Praktikum 2.3

1. konfigiurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::where('level_id', 2)->count();
            dd($user);
            return view('user', ['data' => $user]);
        }
    }
    ```

2. hasil <br>
   ![alt text](/images/p4/image-9.png)
   menghitung julah baris

3. buat view

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Level Pengguna</title>
    </head>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
        }
    </style>

    <body>
        <h1>Data User</h1>
        <table>
            <thead>
                <th>Jumlah Pengguna</th>
            </thead>
            <tbody>
                <td>{{$data}}</td>
            </tbody>
        </table>
    </body>

    </html>
    ```

4. hasil <br>
   ![alt text](/images/p4/image-10.png)

### Praktikum 2.4

1. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrCreate(
                [
                    'username' => 'manager',
                    'nama' => 'Manager'
                ]
            );
            return view('user', ['data' => $user]);
        }
    }

    ```

2. ubah kembali user.blade.php ke sebelumnya

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Level Pengguna</title>
    </head>

    <body>
        <h1>Data Level Pengguna</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
                <th>ID Level Pengguna</th>
            </tr>
            <td>{{$data->user_id}}</td>
            <td>{{$data->username}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->level_id}}</td>
            </tr>
        </table>
    </body>

    </html>
    ```

3. hasil <br>
   ![alt text](/images/p4/image-11.png) <br>
   mthod akan mencoba mencari record database menggunakan pasangan kolom/nilai yang diberikan. Jika model tidak dapat ditemukan dalam database, sebuah record akan disisipkan dengan atribut yang dihasilkan dari penggabungan argumen baris pertama dengan argumen baris kedua yang bersifat opsional.
4. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrCreate(
                [
                'username' => 'manager',
                'nama' => 'Manager',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
            );
            return view('user', ['data' => $user]);
        }
    }

    ```

5. hasil <br>
   ![alt text](/images/p4/image-12.png) <br>
   tidak terjadi apa-apa karena pada UserModel pada $fillabel tidak diinsertkan password

6. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
       public function index()
       {
           $user = UserModel::firstOrCreate(
               [
               'username' => 'manager',
               'nama' => 'Manager',
           ]
           );
           return view('user', ['data' => $user]);
       }
    }

    ```

7. hasil <br>
   ![alt text](/images/p4/image-13.png) <br>
   method akan mencoba menemukan/mengambil record/data dalam database yang cocok dengan atribut yang diberikan. Namun, jika data tidak ditemukan, data akan disiapkan untuk di-insert-kan ke database dan model baru akan dikembalikan

8. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrCreate(
                [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
            );
            return view('user', ['data' => $user]);
        }
    }

    ```

9. hasil <br>
   ![alt text](/images/p4/image-14.png) <br>
   ![alt text](/images/p4/image-15.png) <br>
   data tidak masuk ke DB <br>
10. konfigurasi file UserControler

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrCreate(
                [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
            );
            return view('user', ['data' => $user]);
        }
    }


    ```

11. hasil <br>
    ![alt text](/images/p4/image-16.png) <br>
    ![alt text](/images/p4/image-17.png) <br>
    data masuk ke DB

### Praktikum 2.5

1. Konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrNew(
                [
                    'username' => 'manager55',
                    'nama' => 'Manager55',
                    'password' => Hash::make('12345'),
                    'level_id' => 2
                ]
            );

            $user->username = 'manager56';

            $user->isDirty();
            $user->isDirty('username');
            $user->isDirty('nama');
            $user->isDirty(['nama', 'username']);

            $user->isClean();
            $user->isClean('username');
            $user->isClean('nama');
            $user->isClean(['nama', 'username']);

            $user->save();

            $user->isDirty();
            $user->isClean();
            dd($user->isDirty());
            // return view('user', ['data' => $user]);
        }
    }
    ```

2. hasil <br>
   ![alt text](/images/p4/image-18.png)<br>
   Metode isDirty menentukan apakah ada atribut model yang telah diubah sejak model diambil. Anda dapat meneruskan nama atribut tertentu atau serangkaian atribut ke metode isDirty untuk menentukan apakah ada atribut yang "kotor". Metode ini isClean akan menentukan apakah suatu atribut tetap tidak berubah sejak model diambil.

3. konfigurasi file UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::firstOrNew(
                [
                    'username' => 'manager55',
                    'nama' => 'Manager55',
                    'password' => Hash::make('12345'),
                    'level_id' => 2
                ]
            );

            $user->username = 'manager12';

            $user->save();

            $user->wasChanged();
            $user->wasChanged('username');
            $user->wasChanged(['nama', 'username']);
            $user->wasChanged('nama');

            dd($user->wasChanged(['nama', 'username']));
            // return view('user', ['data' => $user]);
        }
    }

    ```

4. hasil <br>
   ![alt text](/images/p4/image-19.png)<br>
   method ini menentukan apakah ada atribut yang diubah saat model terakhir disimpan dalam siklus permintaan saat ini. Jika diperlukan, Anda dapat memberikan nama atribut untuk melihat apakah atribut tertentu telah diubah

### Praktikum 2.6

1. konfigurasi User.blade.php

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Level Pengguna</title>
    </head>

    <body>
        <h1>Data User</h1>
        <a href="user/tambah">+ Tambah User</a>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Nama</td>
                <td>ID Level Pengguna</td>
                <td>Aksi</td>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->user_id}}</td>
                <td>{{$d->username}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->level_id}}</td>
                <td>
                    <a href="/user/ubah/{{$d->user_id}}">Ubah</a> |
                    <a href="/user/hapus/{{$d->user_id}}">Hapus</a>
                </td>
            </tr>
            @endforeach
        </table>
    </body>

    </html>
    ```

2. konfigurasi UserController

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\UserModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index()
        {
            $user = UserModel::all();
            return view('user', ['data' => $user]);
        }
    }
    ```

3. hasil <br>
   ![alt text](/images/p4/image-20.png)<br>
   membuat tampilan crud sederhana

4. membuat view user_tambah

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Data</title>
    </head>

    <body>
        <h1>Form Tambah Data User</h1>
        <form action="/user/tambah_simpan" method="post">

            {{csrf_field()}}

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukan Username">
            <br>

            <label>Nama</label>
            <input type="text" name="nama" placeholder="Masukan Nama">
            <br>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukan Password">
            <br>

            <label>Level ID</label>
            <input type="number" name="level_id" placeholder="Masukan ID Level">
            <br>

            <input type="submit" value="Simpan" class="btn btn-success">

        </form>
    </body>

    </html>
    ```

5. setting routes <br>
   ![alt text](/images/p4/image-21.png)<br>

6. menambahkan method tambah UserController <br>
   ![alt text](/images/p4/image-22.png) <br>

7. hasil <br>
   ![alt text](/images/p4/image-23.png) <br>
   membuat form untuk menambahkan user <br>

8. membuat route untuk tambah_simpan <br>
   ![alt text](/images/p4/image-24.png) <br>

9. konfigurasi file UserController <br>
   ![alt text](/images/p4/image-25.png) <br>

10. hasil <br>
    ![alt text](/images/p4/image-26.png) <br>
    ![alt text](/images/p4/image-27.png) <br>
    berhasil menambahkan user baru

11. membuat form ubah_data <br>

    ```HTML
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Data</title>
    </head>

    <body>
        <h1>Form Ubah Data User</h1>
        <a href="../">Kembali</a>
        <form action="ubah_simpan/{{$data->user_id}}" method="post">

            {{csrf_field()}}
            {{method_field()}}

            <label>Username</label>
            <input value="{{$data->username}}" type="text" name="username" placeholder="Masukan Username">
            <br>

            <label>Nama</label>
            <input value="{{$data->nama}}" type="text" name="nama" placeholder="Masukan Nama">
            <br>

            <label>Password</label>
            <input value="{{$data->password}}" type="password" name="password" placeholder="Masukan Password">
            <br>

            <label>Level ID</label>
            <input value="{{$data->level_id}}" type="number" name="level_id" placeholder="Masukan ID Level">
            <br>

            <input type="submit" value="Ubah" class="btn btn-success">

        </form>
    </body>

    </html>
    ```

12. membuat routes untuk ubah<br>
    ![alt text](/images/p4/image-28.png) <br>

13. menambhakan function ubah pada UserController <br>
    ![alt text](/images/p4/image-29.png)

14. hasil <br>
    ![alt text](/images/p4/image-30.png)
15. membuat routes untuk ubah_simpan <br>
    ![alt text](/images/p4/image-31.png) <br>
16. menambahkan method ubah_simpan pada UserController <br>
    ![alt text](/images/p4/image-32.png)<br>

17. hasil <br>
    ![alt text](/images/p4/image-33.png)<br>
    ![alt text](/images/p4/image-34.png)<br>
    ![alt text](/images/p4/image-35.png)<br>
    data berhasil dirubah<br>
18. membuat routes untuk hapus <br>
    ![alt text](/images/p4/image-37.png) <br>
19. membuat method hapus pada UserController <br>
    ![alt text](/images/p4/image-36.png) <br>
20. hasil<br>
    ![alt text](/images/p4/image-38.png)<br>

### Praktikum 2.7

1. konfigurasi pada file UserModel <br>
   ![alt text](/images/p4/image-39.png) <br>
2. konfigurasi file UserController <br>
   ![alt text](/images/p4/image-40.png) <br>
3. hasil <br>
   ![alt text](/images/p4/image-41.png)<br>

# Laporan Praktikum Web Lanjut Pertemuan 5

### Praktikum 1

1. require Admin-LTE <br>
   ![alt text](/images/p5/image.png) <br>
2. install admin-LTE <br>
   ![alt text](/images/p5/image-1.png) <br>
3. membuat file pada "resources/views/layout/app.blade.php" <br>
   ![alt text](/images/p5/image-2.png) <br>
   ![alt text](/images/p5/image-3.png) <br>
4. edit isi file welcome.blade.php <br>
   ![alt text](/images/p5/image-4.png) <br>
5. hasil <br>
   ![alt text](/images/p5/image-5.png) <br>

### Praktikum 2

1. install laravel data tables <br>
   ![alt text](/images/p5/image-6.png) <br>
   ![alt text](/images/p5/image-7.png) <br>
2. Install Laravel DataTables Vite dan sass <br>
   ![alt text](/images/p5/image-8.png)<br>
   ![alt text](/images/p5/image-9.png) <br>
3. Edit file resources/js/app.js <br>
   ![alt text](/images/p5/image-10.png)<br>
4. Buat file resources/saas/app.scss <br>
   ![alt text](/images/p5/image-11.png) <br>
5. menjalankan perintah npm ru dev <br>
   ![alt text](/images/p5/image-12.png)<br>
6. menjalankan perintah
    ```
    php artisan datatables:make Kategori
    ```
7. konfigurasi KategoriDataTable

    ```php
    <?php

    namespace App\DataTables;

    use App\Models\KategoriModel;
    use App\Models\m_kategori;
    use Illuminate\Database\Eloquent\Builder as QueryBuilder;
    use Yajra\DataTables\EloquentDataTable;
    use Yajra\DataTables\Html\Builder as HtmlBuilder;
    use Yajra\DataTables\Html\Button;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Html\Editor\Editor;
    use Yajra\DataTables\Html\Editor\Fields;
    use Yajra\DataTables\Services\DataTable;

    class KategoriDataTable extends DataTable
    {
        /**
         * Build the DataTable class.
         *
         * @param QueryBuilder $query Results from query() method.
         */
        public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))
                /* ->addColumn('action', 'kategori.action') */
                ->setRowId('id');
        }
        /**
         * Get the query source of dataTable.
         */
        public function query(m_kategori $model): QueryBuilder
        {
            return $model->newQuery();
        }
        /**
         * Optional method if you want to use the html builder.
         */
        public function html(): HtmlBuilder
        {
            return $this->builder()
                ->setTableId('kategori-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                //->dom('Bfrtip')
                ->orderBy(1)
                ->selectStyleSingle()
                ->buttons([
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload')
                ]);
        }
        /**
         * Get the dataTable columns definition.
         */
        public function getColumns(): array
        {
            return [
                /* Column::computed('action')
    ->exportable(false)
    ->printable(false)
    ->width(60)
    ->addClass('text-center'), */
                Column::make('kategori_id'),
                Column::make('kategori_kode'),
                Column::make('kategori_nama'),
                Column::make('created_at'),
                Column::make('updated_at'),
            ];
        }
        /**
         * Get the filename for export.
         */
        protected function filename(): string
        {
            return 'Kategori_' . date('YmdHis');
        }
    }
    ```

8. ubah m_kategori pada model

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class m_kategori extends Model
    {
        // use HasFactory;
        protected $table = 'm_kategori';
        protected $primaryKey = 'kategori_id';
        protected $filllable = ['kategori_kode', 'kategori_name'];

        public function barang(): HasMany{
            return $this->hasMany(m_barang::class, 'barang_id', 'barang_id');
        }
    }
    ```

9. konfiguasi KategoriController

    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\DataTables\KategoriDataTable;

    class KategoriController extends Controller
    {
        public function index(KategoriDataTable $dataTable)
        {
            // $data = [
            //     'kategori_kode' => 'SNK',
            //     'kategori_nama' => 'Snack/Makanan Ringan',
            //     'created_at' => now()
            // ];

            // DB::table('m_kategoris')->insert($data);
            // return 'insert data baru berhasil';

            return $dataTable->render('kategori.index');
        }
    }

    ```

10. membuat folder kategori pada resources

    ```php
    @extends('layout.app')

    {{-- Customize layout section --}}

    @section('subtitle', 'Welcome')
    @section('content_header_title', 'Home')
    @section('content_header_subtitle', 'Kategori')

    {{-- Customize body:main page content --}}

    @section('content')
        <div class="container">
            <div class="card">
                <div class="card-header">Manage Kategori</div>
                <div class="card-body">
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        {{$dataTable->script()}}
    @endpush
    ```

11. membuat route <br>
    ![alt text](/images/p5/image-13.png)<br>

12. konfigurasi app pada folder layout<br>
    ![alt text](/images/p5/image-14.png)<br>
    ![alt text](/images/p5/image-15.png)<br>
13. Menset ViteJs / script type defaults

    ```php
    <?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Yajra\DataTables\Html\Builder;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            //
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Builder::useVite();
        }
    }

    ```

14. mengisikan beebrapa daa ke table kategori
15. hasil <br>
    ![alt text](/images/p5/image-16.png)<br>

### Praktikum 3

1. konfigurasi route<br>
   ![alt text](/images/p5/image-17.png)<br>
2. menambahkan 2 function pada KategoriController<br>
   ![alt text](/images/p5/image-18.png)<br>
3. buat file create.blade.php pada folder views/kategori <br>
   ![alt text](/images/p5/image-19.png) <br>
4. konfigurasi csrfToken <br>
   ![alt text](/images/p5/image-20.png)<br>
5. hasil <br>
   ![alt text](/images/p5/image-21.png) <br>
   ![alt text](/images/p5/image-22.png) <br>
   ![alt text](/images/p5/image-23.png) <br>

### Tugas

1. menambahkan button add pada halaman manage kategori <br>
   ![alt text](/images/p5/image-24.png)<br>
   ![alt text](/images/p5/image-25.png)<br>
   ![alt text](/images/p5/image-26.png)<br>
2. menambahkan menu untuk halaman manage kategori, di daftar menu navbar <br>
   ![alt text](/images/p5/image-27.png)<br>
   ![alt text](/images/p5/image-28.png)<br>
3. menambahkan action data tables <br>
   ![alt text](/images/p5/image-29.png) <br>
   ![alt text](/images/p5/image-30.png) <br>
   ![alt text](/images/p5/image-31.png) <br>
4. membuat action delete <br>
   ![alt text](/images/p5/image-29.png) <br>  
   ![alt text](/images/p5/image-32.png) <br>

# Laporan Praktikum Web Lanjut Pertemuan 6

### Template Form

1. download source code <br>
   ![alt text](/images/p6/image.png) <br>
2. memindahkan file template pada folder public <br>
   ![alt text](/images/p6/image-1.png)<br>
3. edit bagian yang telah ditentukan<br>
   ![alt text](/images/p6/image-4.png) <br>
4. konfigurasi kode yang telah ditentukan <br>
   ![alt text](/images/p6/image-3.png) <br>
5. hasil <br>
   ![alt text](/images/p6/image-4.png)<br>
6. menggunakan general form <br>
   ![alt text](/images/p6/image-5.png) <br>
7. apa yang tampil? <br>
   yang tampil adalah general form yang disalin tadi <br>
8. advanced elements<br>
   ![alt text](/images/p6/image-6.png) <br>
   ![alt text](/images/p6/image-7.png) <br>
9. editor <br>
   ![alt text](/images/p6/image-8.png) <br>
10. validation <br>
    ![alt text](/images/p6/image-9.png) <br>
    membuat form untuk tabel m_user<br>
    ![alt text](/images/p6/image-10.png)<br>
    ![alt text](/images/p6/image-11.png)<br>
    membuat form untuk tabel level<br>
    ![alt text](/images/p6/image-12.png)<br>
    ![alt text](/images/p6/image-13.png)<br>

### Validasi Pada Server

1. mendefinisikan route <br>
   ![alt text](/images/p6/image-14.png)<br>
2. edit fungsi <br>
   ![alt text](/images/p6/image-15.png)<br>
3. perbedaan validate dan validateWithBag <br>
   validate() dan validateWithBag() adalah dua metode validasi yang disediakan oleh Laravel untuk memeriksa data yang diterima melalui permintaan HTTP. Perbedaan utamanya terletak pada cara pengembalian hasil validasi. Metode validate() secara otomatis mengembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan validasi jika validasi gagal, sedangkan validateWithBag() memungkinkan Anda untuk menentukan di mana pesan kesalahan validasi disimpan, yang berguna jika Anda ingin menangani tampilan pesan kesalahan secara manual atau melakukan validasi secara asinkron.
4. Menggunakan bail untuk menghentikan validasi pada field setelah kegagalan validasi pertama, Sehingga, jika validasi untuk kode_kategori gagal, maka Laravel akan menghentikan validasi dan tidak mengevaluasi aturan validasi untuk nama_kategori. <br>
![alt text](/images/p6/image-16.png)<br>
5. Pada view/create.blade.php tambahkan code berikut agar ketika validasi gagal, kita dapat menampilkan pesan kesalahan dalam tampilan:<br>
![alt text](/images/p6/image-17.png)<br>
6. hasil <br>
![alt text](/images/p6/image-18.png)<br>
7. Pada view/create.blade.php tambahkan dan coba running code berikut <br>
![alt text](/images/p6/image-19.png)<br>
![alt text](/images/p6/image-20.png)<br>

### Form Request Validation
1. Membuat permintaan form dengan menuliskan pada terminal<br>
![alt text](/images/p6/image-21.png)<br>
2. Ketik kode berikut pada Http/request/StorePostRequest <br>
![alt text](/images/p6/image-22.png)<br>
![alt text](/images/p6/image-23.png)<br>
3. Terapkan validasi juga pada tabel m_user dan m_level.


### CRUD 
1. Buat POSController lengkap dengan resourcenya, Membuat Resource Controller dan Route yang berfungsi untuk route CRUD sehingga tidak perlu repot-repot membuat masing-masing route seperti post, get, delete dan update.
![alt text](/images/p6/image-24.png)<br>
2. Tambahkan kode pada route/web.php <br>
![alt text](/images/p6/image-25.png)<br>
3. Atur pada Models <br>
![alt text](/images/p6/image-26.png)<br>
4. atur pada migratiokn <br>
![alt text](/images/p6/image-27.png)<br>
5. Buka app/Http/Controllers/POSController.php kemudian ketikkan, kodenya seperti berikut ini<br>
![alt text](/images/p6/image-28.png)<br>
6. Buatlah folder di Resources/Views/m_user dengan beberapa blade dan isian kode berikut <br>
![alt text](/images/p6/image-29.png)<br>
![alt text](/images/p6/image-30.png)<br>
![alt text](/images/p6/image-31.png)<br>
![alt text](/images/p6/image-32.png)<br>
![alt text](/images/p6/image-33.png)<br>
7. silahkan akses localhost/m_user<br>
![alt text](/images/p6/image-34.png)<br>

### Tugas
1. menampilkan level_id:<br>
![alt text](/images/p6/image-34.png)<br>
2. modifikasi tema kesukaan:
![alt text](/images/p6/image-35.png)<br>
3. Apa fungsi $request->validate, $error dan alert yang ada pada halaman CRUD tersebut? <br>
$request->validate adalah sebuah metode yang digunakan untuk memvalidasi input yang diterima dari pengguna. Validasi dilakukan berdasarkan aturan yang telah didefinisikan di dalam metode rules() pada file Form Request atau secara langsung di dalam controller. Jika validasi gagal, maka metode ini akan mengembalikan pesan kesalahan.
<br>$errors adalah sebuah variabel yang digunakan untuk menyimpan pesan-pesan kesalahan yang dihasilkan dari validasi input. Jika validasi gagal, pesan kesalahan akan disimpan di dalam variabel ini. Variabel ini dapat diakses di dalam tampilan Blade untuk menampilkan pesan kesalahan kepada pengguna.
<br>alert adalah sebuah elemen HTML yang digunakan untuk menampilkan pesan kesalahan kepada pengguna. Dalam konteks halaman CRUD, pesan kesalahan biasanya ditampilkan dalam elemen alert untuk memberi tahu pengguna tentang kesalahan yang terjadi selama proses validasi atau operasi CRUD.
<br>Dengan menggunakan fungsi $request->validate untuk validasi input dan variabel $errors untuk menangani pesan kesalahan, serta menggunakan elemen alert di dalam tampilan Blade, kita dapat dengan efektif mengelola validasi input dan memberikan umpan balik kepada pengguna.

