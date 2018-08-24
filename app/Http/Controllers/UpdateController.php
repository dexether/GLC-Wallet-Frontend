<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Borrower;
use App\Models\Branch;
use App\Models\BranchUser;
use App\Models\JournalEntry;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\LoanSchedule;
use App\Models\LoanTransaction;
use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {

        $path = storage_path() . "/updates/update.zip";
        $url = $_REQUEST['url'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $fp = fopen($path, 'w+');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        $output = curl_exec($ch);
        if ($output) {
            $msg = trans_choice('general.file_downloaded_successfully', 1);
        } else {
            $error = trans_choice('general.failed_to_download_file', 1);
        }
        curl_close($ch);
        fclose($fp);

        return view('update.download', compact('msg', 'error'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function install()
    {
        if (file_exists(storage_path() . "/updates/update.zip")) {
            //begin the update
            $zip = new \ZipArchive();
            if ($zip->open(storage_path() . "/updates/update.zip") === TRUE) {
                $res = $zip->extractTo(storage_path("updates"));
                $zip->close();
                //run new migrations
                Artisan::call('view:clear');
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Artisan::call('migrate');
                unlink(storage_path() . "/updates/update.zip");
                Flash::warning(trans('general.update_successful'));
                return redirect('update/finish');
            } else {
                Flash::warning(trans('general.update_file_does_not_exist'));
                return redirect()->back();
            }
        } else {
            Flash::warning(trans('general.update_file_does_not_exist'));
            return redirect()->back();
        }
        //return view('tax.create', compact(''));
    }

    public function finish()
    {

        return view('update.finish', compact(''));
    }









}
