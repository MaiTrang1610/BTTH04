<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Hiển thị danh sách các đồ án kiểu CÓ PHÂN TRANG dùng paginate
    public function index()
    {
       // Sử dụng paginate thay vì all()
       $issues = Issue::with('computer')->paginate(10); // Lấy 5 bản ghi mỗi trang
       return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $computers = Computer::all(); // Lấy danh sách sinh viên để chọn
        return view('issues.create', compact('computers'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'computer_id'=> 'required',
            'reported_id'=> 'required|max:50',
            'reported_'=> 'required|datetime',
            'desccription'=> 'required|text',
            'urgency'=> 'required|in:Low,Medium,High',
            'status'=> 'required|in:Open, In Progress, Resolve',
        ]);
        Issue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm thành công!');
    }

   
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $computers = Computer::all(); 

        return view('issues.edit', compact('issue', 'computers'));
    }

   //cập nhật thông tin vấn đề
   public function update(Request $request, Issue $issue)
   {
       $request->validate([
           'computer_id' => 'required',
           'reported_id' => 'required|max:50',
           'reported_' => 'required|datetime',
           'description' => 'required|text',
           'urgency' => 'required|in:Low,Medium,High',
           'status' => 'required|in:Open, In Progress, Resolve',
       ]);
   
       $issue->update($request->all());
   
       return redirect()->route('issues.index')->with('success', 'Vấn đề được cập nhật thành công');
   }
        //Xoá vấn đề
    public function destroy(string $id)
    {
        $Issue = Issue::findOrFail($id);
        $Issue->delete();

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công!');
        // $issue = Issue::findOrFail($id);

        // if (request('confirm') === 'yes') {
        //     $issue->delete();
        //     return redirect()->route('issues.index')->with('success', 'Xóa vấn đề thành công!');
        // }
    
        // return redirect()->route('issues.index')->with('warning', 'Xóa bị hủy!');

    }
}
