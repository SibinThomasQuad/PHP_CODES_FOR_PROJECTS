abort(404);

OR

return response()->view('errors.404', [], 404);
