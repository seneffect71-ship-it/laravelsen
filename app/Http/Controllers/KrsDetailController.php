        $user = session('user');
        // Hanya dosen dan admin yang bisa approve/reject detail KRS
        if (!in_array($user['role'], ['dosen', 'admin'])) {
            return redirect('/krs')->with('message', 'Akses tidak diizinkan.');
        }
