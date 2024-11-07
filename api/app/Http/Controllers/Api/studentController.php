<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    //
    public function index() {
        $students = Student::all();
        $status = 200;
        $data = [
            'students' => $students,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10'
        ]);
        if ($validator->fails()) {
            $status = 400;
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        if (!$student) {
            $status = 500;
            $data = [
                'message' => 'Error al crear un estudiante',
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $status = 201;
        $data = [
            'message' => 'Estudiante creado correctamente',
            'student' => $student,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    public function show($id) {
        $student = Student::find($id);
        if (!$student) {
            $status = 404;
            $data = [
                'message' => 'Student nor found',
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $status = 200;
        $data = [
            'student' => $student,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    public function destroy($id) {
        $student = Student::find($id);
        if (!$student) {
            $status = 404;
            $data = [
                'message' => 'Student nor found',
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $student->delete();
        $status = 200;
        $data = [
            'message' => 'estudiante eliminado',
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    public function update(Request $request, $id) {
        $student = Student::find($id);
        if (!$student) {
            $status = 404;
            $data = [
                'message' => 'Student nor found',
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10'
        ]);
        if ($validator->fails()) {
            $status = 400;
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        $status = 200;
        $data = [
            'message' => 'estudiante modificado',
            'student' => $student,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    public function updatePartial(Request $request, $id) {
        $student = Student::find($id);
        if (!$student) {
            $status = 404;
            $data = [
                'message' => 'Student nor found',
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email',
            'phone' => 'digits:10'
        ]);
        if ($validator->fails()) {
            $status = 400;
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => $status
            ];
            return response()->json($data, $status);
        }
        if ($request->has('name')) {
            $student->name = $request->name;
        }
        if ($request->has('email')) {
            $student->email = $request->email;
        }
        if ($request->has('phone')) {
            $student->phone = $request->phone;
        }
        $student->save();
        $status = 200;
        $data = [
            'message' => 'estudiante modificado',
            'student' => $student,
            'status' => $status
        ];
        return response()->json($data, $status);
    }
}
