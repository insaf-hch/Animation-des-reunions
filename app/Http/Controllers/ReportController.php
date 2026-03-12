<?php
namespace App\Http\Controllers;
use App\Models\Meeting;
class ReportController extends Controller {
  public function index() {
    $meetings = Meeting::where('statut','Terminee')->orderBy('date_reunion','desc')->get();
    return view('report.index', compact('meetings'));
  }
  public function show(Meeting $meeting) {
    $meeting->load(['participants.user','agendas','decisions','tasks','notes']);
    return view('report.show', compact('meeting'));
  }
  public function pdf(Meeting $meeting) {
    $meeting->load(['participants.user','agendas','decisions','tasks','notes']);
    return view('report.show', compact('meeting'));
  }
}
