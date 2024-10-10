<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = [
            'Bendahara',
            'Buku Ber-ISBN Penulis Kedua dst',
            'Buku Ber-ISBN Penulis Utama',
            'Finalis',
            'Hak Cipta',
            'Juara 1',
            'Juara 2',
            'Juara 3',
            'Ketua',
            'Kewirausahaan',
            'Koordinator Relawan',
            'Medali Emas',
            'Medali Perak',
            'Medali Perunggu',
            'Moderator',
            'Narasumber/Pembicara',
            'Patent',
            'Patent Sederhana',
            'Pelatih/Wasit/Juri Berlisensi',
            'Pelatih/Wasit/Juri Tidak Berlisensi',
            'Pemrakarsa/Pendiri',
            'Penerima Hibah Kompetisi',
            'Pengakuan Lainnya',
            'Penghargaan Lainnya',
            'Penulis Utama/korespondensi karya ilmiah di journal yg bereputasi dan diakui',
            'Penulis kedua (bukan korespondensi) dst karya ilmiah di journal yg bereputasi dan diakui',
            'Piagam Partisipasi',
            'Relawan',
            'Satu Tingkat Dibawah Pengurus Harian',
            'Sekretaris',
            'Tanda Jasa',
            'Wakil Ketua',
        ];

        $levels = [
            'External International',
            'External National',
            'External Regional',
            'Internal '
        ];

        return view('form', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntryRequest $request)
    {
        $request->validate([
            'status' => 'required|string',
            'participant_as' => 'required|string',
            'total_participants' => 'required|integer',
            'level' => 'required|string',
        ]);

        $entry = new Entry();
        $entry->student_id = auth()->user()->id;
        $entry->status = $request->status;
        $entry->participant_as = $request->participant_as;
        $entry->level = $request->level;
        $entry->save();

        return redirect()->route('dashboard')->with('success', 'Entry submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntryRequest $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
