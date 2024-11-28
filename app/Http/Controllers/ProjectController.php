<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        // Hanya menampilkan project milik user yang sedang login
        $projects = Project::where('user_id', Auth::id())->paginate(10);
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ], [
            'name.required' => 'Nama proyek harus diisi.',
            'name.max' => 'Nama proyek tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi proyek harus diisi.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required' => 'Tanggal selesai harus diisi.',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.', // Pesan kesalahan khusus
        ]);

        // Tambahkan user_id dari user yang sedang login
        $validatedData['user_id'] = Auth::id();

        Project::create($validatedData);

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dibuat.');
    }

    public function show(Project $project)
    {
        // Pastikan hanya pemilik project yang bisa melihat
        $this->authorize('view', $project);

        // Ambil tasks yang terkait dengan project
        $tasks = $project->tasks;
        return view('project.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        if (Auth::id() !== $project->user_id) {
            return abort(403, 'Anda tidak memiliki izin untuk mengedit proyek ini.');
        }

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        if (Auth::id() !== $project->user_id) {
            return abort(403, 'Anda tidak memiliki izin untuk mengupdate proyek ini.');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ], [
            'name.required' => 'Nama proyek harus diisi.',
            'name.max' => 'Nama proyek tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi proyek harus diisi.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required' => 'Tanggal selesai harus diisi.',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.', // Pesan kesalahan khusus
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil diupdate.');
    }

    public function destroy(Project $project)
    {

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
