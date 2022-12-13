<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PDF;


class LeadController extends Controller
{
    public function print($id)
    {
        $data = Lead::with('category')->whereId($id)->first();
        $send = [
            'category'     => $data->category->title,
            'nama'         => $data->nama,
            'nik'          => $data->nik,
            'email'        => $data->email,
            'gender'       => $data->gender,
            'agama'        => $data->agama,
            'tinggi'       => $data->tinggi,
            'berat'        => $data->berat,
            'telp'         => $data->telp,
            'tempat_lahir' => $data->tempat_lahir,
            'tgl_lahir'    => $data->tgl_lahir,
            'alamat'       => $data->alamat,
            'alamat_surat' => $data->alamat_surat,
            'kawin'        => $data->kawin,
            'pendidikan'   => $data->pendidikan,
            'pekerjaan'    => $data->pekerjaan,
            'status'       => $data->status,
            'pas_foto'     => $data->pas_foto,
            'ktp'          => $data->ktp,
        ];

        $pdf = PDF::loadView('kandidat.resume.pdf', $send);
        return $pdf->stream('myresume.pdf');
    }
    public function intLead(Request $request, $id)
    {
        // dd($request->all(), $id);
        $user = Lead::findOrFail($id);
        try {
            $user->status         = 'interviewed';
            $user->notes          = $request->notes;
            $user->interviewed_at = date('Y-m-d');
            $user->save();
            return redirect('/kandidat')->with('success', 'Data Kandidat Berhasil Diperbaharui!');
        } catch (\Throwable $th) {
            return redirect('/kandidat')->with('error', $th->getMessage());
        }
    }
    public function apprLead(Request $request, $id)
    {
        $user = Lead::findOrFail($id);
        try {
            $user->status       = 'approved';
            $user->pekerjaan    = 'aktif';
            $user->lokasi_kerja = $request->location;
            $user->approved_at  = date('Y-m-d');
            $user->save();
            Recommendation::create([
                'comp_id' => $request->location,
                'leads_id' => $id,
                'tgl_rekom' => date('Y-m-d'),
                'keterangan' => 'Tanpa Note'
            ]);
            return redirect('/kandidat')->with('success', 'Data Kandidat Berhasil Diperbaharui!');
        } catch (\Throwable $th) {
            return redirect('/kandidat')->with('error', $th->getMessage());
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Lead::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('detail_nama', function ($row) {
                    $usia = Carbon::parse($row->tgl_lahir)->age;
                    return '<div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                <div class="fw-bold">' . $row->nama . '</div>
                                <div class="text-muted"><small class="text-reset">' .  $row->gender . ', ' . $usia . ' tahun</small></div>
                                <div class="text-muted"><small class="badge bg-indigo-lt">' . strtoupper($row->category->title) . '</small></div>
                              </div>
                            </div>';
                })
                ->addColumn('detail_next', function ($row) {
                    return '<div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                <div class="text-muted"><small class="text-reset">Agama: ' .  ucwords(strtolower($row->agama)) . '</small></div>
                                <div class="text-muted"><small class="text-reset">Status Kawin: ' .  $row->kawin . '</small></div>
                                <div class="text-muted"><small class="text-reset">Status Bekerja: ' .  $row->pekerjaan . '</small></div>
                              </div>
                            </div>';
                })
                ->addColumn('detail_badan', function ($row) {
                    $tinggi = !$row->tinggi ? 0 : number_format($row->tinggi);
                    $berat = !$row->berat ? 0 : number_format($row->berat);
                    return '<div>' . $tinggi  . 'cm</div>
                            <div class="text-muted">' . $berat  . 'kg</div>';
                })
                ->addColumn('sm_alamat', function ($row) {
                    $str = substr($row->alamat, 0, 40);
                    return '<div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                <div class="fw-bold">62' . $row->telp . '</div>
                                <div class="text-muted"><small class="text-reset">' . $str . '..</small></div>
                              </div>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                          <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item" href="' . route('kandidat.show', $row->id) . '">
                                    Detail
                            </a>
                            <form action="' . route('kandidat.destroy', $row->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                          </div>
                        </div>';
                })
                ->addColumn('stats', function ($row) {
                    if ($row->status == 'interviewed') {
                        $class = 'bg-orange';
                    } elseif ($row->status == 'approved') {
                        $class = 'bg-success';
                    } elseif ($row->status == 'rejected') {
                        $class = 'bg-danger';
                    } else {
                        $class = 'bg-azure-lt';
                    }
                    return '<div class="text-muted"><small class="badge ' . $class . '">' . strtoupper($row->status) . '</small></div>';
                })
                ->rawColumns(['stats', 'sm_alamat', 'detail_nama', 'detail_next', 'detail_badan', 'action'])
                ->make(true);
        }

        return view('kandidat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::all();
        return view('kandidat.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required',
            'nik'          => 'required',
            'nama'         => 'required',
            'agama'        => 'required',
            'gender'       => 'required',
            'tempat_lahir' => 'required',
            'alamat'       => 'required',
            'alamat_surat' => 'required',
            'tgl_lahir'    => 'required|date',
            'email'        => 'email',
            'telp'         => 'required',
            'tinggi'       => 'numeric',
            'berat'        => 'numeric',
            'kawin'        => 'required',
            'pendidikan'   => 'required',
            'pekerjaan'    => 'required',
        ]);

        try {
            $input = $request->all();

            if ($request->hasFile('cv')) {
                $input['cv'] = Str::snake($request->nama) . '_CV' . '.' . $request->file('cv')->getClientOriginalExtension();
                $request->file('cv')->storeAs('public/cv', $input['cv']);
            }
            if ($request->hasFile('ktp')) {
                $input['ktp'] = Str::snake($request->nama) . '_KTP' . '.' . $request->file('ktp')->getClientOriginalExtension();
                $request->file('ktp')->storeAs('public/ktp', $input['ktp']);
            }
            if ($request->hasFile('pas_foto')) {
                $input['foto'] = Str::snake($request->nama) . '_FOTO' . '.' . $request->file('pas_foto')->getClientOriginalExtension();
                $request->file('pas_foto')->storeAs('public/pas_foto', $input['foto']);
            }

            Lead::updateOrCreate(
                [
                    'nik'          => $input['nik'],
                ],
                [
                    'category_id'  => $input['category_id'],
                    'user_id'      => auth()->user()->id,
                    'nama'         => $input['nama'],
                    'agama'        => $input['agama'],
                    'gender'       => $input['gender'],
                    'tempat_lahir' => $input['tempat_lahir'],
                    'alamat'       => $input['alamat'],
                    'alamat_surat' => $input['alamat_surat'],
                    'tgl_lahir'    => $input['tgl_lahir'],
                    'email'        => $input['email'],
                    'telp'         => $input['telp'],
                    'tinggi'       => $input['tinggi'],
                    'berat'        => $input['berat'],
                    'kawin'        => $input['kawin'],
                    'pendidikan'   => $input['pendidikan'],
                    'pekerjaan'    => $input['pekerjaan'],
                    'ktp'          => $input['ktp'],
                    'cv'           => $input['cv'],
                    'pas_foto'     => $input['foto'],

                ]
            );
            return response()->json(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Lead::findOrFail($id);
        return view('kandidat.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat  = Category::all();
        $data = Lead::findOrFail($id);
        return view('kandidat.edit', compact('data', 'cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lead)
    {
        try {
            $request->validate([
                'category_id'  => 'required',
                'nik'          => 'required',
                'nama'         => 'required',
                'agama'        => 'required',
                'gender'       => 'required',
                'tempat_lahir' => 'required',
                'alamat'       => 'required',
                'alamat_surat' => 'required',
                'tgl_lahir'    => 'required|date',
                'email'        => 'email',
                'telp'         => 'required',
                'tinggi'       => 'numeric',
                'berat'        => 'numeric',
                'kawin'        => 'required',
                'pendidikan'   => 'required',
                'pekerjaan'    => 'required',
            ]);

            $user               = Lead::findOrFail($lead);
            $user->nik          = $request->nik;
            $user->category_id  = $request->category_id;
            $user->user_id      = auth()->user()->id;
            $user->nama         = $request->nama;
            $user->agama        = $request->agama;
            $user->gender       = $request->gender;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->alamat       = $request->alamat;
            $user->alamat_surat = $request->alamat_surat;
            $user->tgl_lahir    = $request->tgl_lahir;
            $user->email        = $request->email;
            $user->telp         = $request->telp;
            $user->tinggi       = $request->tinggi;
            $user->berat        = $request->berat;
            $user->kawin        = $request->kawin;
            $user->pendidikan   = $request->pendidikan;
            $user->pekerjaan    = $request->pekerjaan;

            if ($request->hasFile('cv')) {
                $cv   = Str::snake($request->nama) . '_CV' . '.' . $request->file('cv')->getClientOriginalExtension();
                $user->cv    = $request->cv;
                $request->file('cv')->storeAs('public/cv', $cv);
            }
            if ($request->hasFile('ktp')) {
                $ktp  = Str::snake($request->nama) . '_KTP' . '.' . $request->file('ktp')->getClientOriginalExtension();
                $user->ktp    = $request->ktp;
                $request->file('ktp')->storeAs('public/ktp', $ktp);
            }
            if ($request->hasFile('pas_foto')) {
                $foto = Str::snake($request->nama) . '_FOTO' . '.' . $request->file('pas_foto')->getClientOriginalExtension();
                $user->pas_foto    = $request->pas_foto;
                $request->file('pas_foto')->storeAs('public/pas_foto', $foto);
            }
            $user->save();
            return response()->json(['success' => 'Data Berhasil Diperbaharui!']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy($lead)
    {
        try {
            $id = Lead::findOrFail($lead);
            $id->delete();
            return redirect()->route('kandidat.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('kandidat.index')->withError($th->getMessage());
        }
    }
}
