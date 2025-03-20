<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use App\Models\Header;
use App\Models\Link;
class LinkSetting extends Component
{
    // public $profil;
    public $items = [];
    // public $sortedItems = [];
    protected $listeners = ['updateOrder'];
    public function mount()
    {
        // Ambil data profil user yang login
        $id = Auth::user()->id;
        $profil = Profil::with(['header', 'link', 'socialmedia'])
                            ->where('user_id', $id)
                            ->where('status', 'on')
                            ->firstOrFail();

        // Gabungkan headers & links, lalu urutkan berdasarkan `position`
        // $this->sortedItems = collect($this->profil->header)
        //                         ->merge($this->profil->link)
        //                         ->sortBy(function ($item) {
        //                             // Cek apakah `position` mengandung "custom"
        //                             if (preg_match('/^cusher (\d+)$/', $item->position, $matches)) {
        //                                 return (int) $matches[1]; // Prioritas tinggi
        //                             } elseif (preg_match('/^cuslink (\d+)$/', $item->position, $matches)) {
        //                                 return (int) $matches[1] + 1000; // Lebih rendah dari "custom"
        //                             }
        //                             return 9999; // Posisi default
        //                         })
        //                         ->values() // Reset indeks array
        //                         ->toArray();
          // Gabungkan headers & links, tambahkan `type`, lalu urutkan berdasarkan `position`
        $headers = collect($profil->header)->map(function ($item) {
            $item['type'] = 'header';  // Tambahkan tipe header
            return $item;
        });

        $links = collect($profil->link)->map(function ($item) {
            $item['type'] = 'link';  // Tambahkan tipe link
            return $item;
        });

        $this->items = $headers->merge($links)
            ->sortBy('position')
            ->values()
            ->toArray();
        // $this->items  = collect($profil->header)
        // ->merge($profil->link)
        // ->sortBy('position')
        // ->values();
        // ->toArray();
       // $this->dispatch('updateOrder',  $this->items);
    //    $this->dispatch('updateOrder',  $this->items);
    }
    // #[On('updateOrder')] 
    public function updateOrder($positions)
    {
        //\Log::info("Attempting to update positions with data: ", $positions);
            // Pastikan data dalam bentuk array
            if (is_string($positions)) {
                $positions = json_decode($positions, true);
            }
        
            foreach ($positions as $position) {
                if ($position['type'] == 'header') {
                    Header::where('id', $position['id'])->update(['position' => $position['position']]);
                } else {
                    Link::where('id', $position['id'])->update(['position' => $position['position']]);
                }
            }
        // **Debugging**
        \Log::info("🟢 Data posisi yang dikirim ke iframe:", $positions);

        // 🔥 Tambahkan delay agar data pasti tersimpan sebelum dikirim ke iframe
      
        sleep(1);
    
        $this->dispatch('updateOrder', $positions);
        // Refresh data setelah update
       
       
        //    sleep(1);
                $this->mount();
    }
    public function render()
    {
        return view('livewire.link-setting',[
            'items' => $this->items
        ]);
    }
}
