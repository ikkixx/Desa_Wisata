use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriWisataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_wisata')->insert([
            ['nama_kategori' => 'Pantai', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Gunung', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Hutan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
