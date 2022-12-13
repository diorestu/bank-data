<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Lead;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $count = Lead::where('category_id', $row->id)->count();
                    $counter = $count > 0 ? 'Lihat ' . $count . ' Kandidat' : 'Tidak Tersedia';
                    return '<div class="d-flex justify-content-end align-items-center">
                            <a class="btn btn-sm btn-outline-teal btn-pill me-2" href="' . route('kategori.show', $row->id) . '">' . $counter . '
                            </a>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        $category = Lead::select(DB::raw('count(*) as count'), 'categories.title')
            ->leftJoin('categories', 'categories.id', '=', 'leads.category_id')
            ->groupBy('categories.title')
            ->pluck('count', 'categories.title');

        $data['labels']  = $category->keys();
        $data['values']  = $category->values();

        return view('kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $save = Category::create([
                'title' => $request->title,
            ]);
            if ($save) {
                return redirect('/kategori')->with('success', 'Kategori ' . $save->title . ' Berhasil Ditambahkan!');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category, Request $request)
    {
        if ($request->ajax()) {
            $data = Lead::query()->where('category_id', $category);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-teal">' . $row->roles . '</span>';
                })
                ->addColumn('detail_nama', function ($row) {
                    return '<div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                <div class="font-weight-medium">' . $row->nama . '</div>
                                <div class="text-muted"><small class="text-reset">' . $row->tempat_lahir . ', ' . getUmur($row->tgl_lahir) . '</small></div>
                                <div class="text-muted"><small class="text-reset"><span class="badge bg-blue">' . $row->status . '</span></small></div>
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
                    return '<small>' . substr($row->alamat, 0, 40) . '..</small>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex align-items-center">
                            <a class="btn btn-sm btn-ghost-info" href="' . route('kandidat.edit', $row->id) . '">
                                Edit
                            </a>
                            <form action="' . route('kandidat.destroy', $row->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-ghost-danger">Hapus</button>
                            </form>
                        </div>';
                })
                ->rawColumns(['status', 'sm_alamat', 'detail_nama', 'detail_badan', 'action'])
                ->make(true);
        }
        $data = Category::findOrFail($category);
        $count = Lead::where('category_id', $category)->count();
        return view('kategori.detail', [
            'id'    => $category,
            'count' => $count,
            'data'  => $data->title,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $data = Category::findOrFail($category);
        return view('kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $input = $request->all();
        try {
            $data = Category::findOrFail($category);
            $data->title = $input['title'];
            $data->save();
            return redirect('/kategori')->with('success', 'Kategori Berhasil Diperbaharui!');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
