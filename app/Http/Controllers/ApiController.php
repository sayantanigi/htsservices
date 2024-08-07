<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Listings;
use App\Models\listingGallery;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ApiController extends Controller
{
    public function store(Request $request)
    {
    	$ssn_number = $request->input('ssn_number');
        $phone = $request->input('phone');
        $email = trim($request->input('email'));
        $first_name = trim($request->input('first_name'));
        $form_pdf = trim($request->input('form_pdf'));
        $position_applied_for = $request->input('position_applied_for');

        $validator = Validator::make($request->all(), [
            'first_name' =>    'required',
            'ssn_number' => 'required',
            // 'email'     => 'required|email',
            'phone' => 'required',
            'date_of_birth' => 'required|date',
          ]);

          if(!$validator->passes()){
            return response()->json([
               'status'=>'0', 
               'error'=>$validator->errors()->toArray()
            ], 200);
          }

          $isExist = User::where('ssn_number',$ssn_number)
            ->where('phone',$phone)
            ->exists();

        if ($isExist) {
            // Update
            $userData = array(
                'prefix'                => trim($request->input('prefix')),
                'first_name'            => trim($request->input('first_name')),
                'last_name'             => trim($request->input('last_name')),
                'email'                 => trim($request->input('email')),
                'date_of_birth'         => trim($request->input('date_of_birth')),
                'street_address'        => trim($request->input('street_address')),
                'apartment'             => trim($request->input('apartment')),
                'city'                  => trim($request->input('city')),
                'state'                 => trim($request->input('state')),
                'zip_code'              => trim($request->input('zip_code')),
                'updated_at'            => date('Y-m-d h:i:s')
            );
    
            $user = User::where('ssn_number', $ssn_number)
                ->where('phone',$phone)
                ->update($userData);

            $userId = User::where('ssn_number', $ssn_number)
                ->where('phone',$phone)
                ->pluck('id')
                ->first();

            $JobData = new Jobstatus();

            $JobData->user_id                     = $userId;
            $JobData->job_applied                 = date('Y-m-d');
            $JobData->job_applied_time            = date('h:i');
            $JobData->form_pdf                    = @$form_pdf;
            $JobData->position_applied_for        = @$position_applied_for;
            $JobData->job_status                  = '1';
            $JobData->created_at                  = date('Y-m-d h:i:s');

            $JobData->save();
        } else {
            // Insert
            $userData = array(
                'prefix'                => trim($request->input('prefix')),
                'first_name'            => trim($request->input('first_name')),
                'last_name'             => trim($request->input('last_name')),
                'ssn_number'            => trim($request->input('ssn_number')),
                'email'                 => trim($request->input('email')),
                'phone'                 => trim($request->input('phone')),
                'date_of_birth'         => trim($request->input('date_of_birth')),
                'street_address'        => trim($request->input('street_address')),
                'apartment'             => trim($request->input('apartment')),
                'city'                  => trim($request->input('city')),
                'state'                 => trim($request->input('state')),
                'zip_code'              => trim($request->input('zip_code')),
                'status'                => 1,
                'created_at'            => date('Y-m-d h:i:s')
            );
    
            $userId = User::insertGetId($userData);

            $JobData = new Jobstatus();

            $JobData->user_id                     = $userId;
            $JobData->job_applied                 = date('Y-m-d');
            $JobData->position_applied_for        = @$position_applied_for;
            $JobData->job_applied_time            = date('h:i');
            $JobData->form_pdf                    = @$form_pdf;
            $JobData->job_status                  = '1';
            $JobData->created_at                  = date('Y-m-d h:i:s');

            $JobData->save();
        }

        if ($userId) {

            // Sent Email to Presenter
            $from = 'no-reply@goigi.com';
            $subject = 'User Login Credentials message From PICD Staffing';
            $url = url('');
            $imagePath = asset('/assets/img/logo.png');

            $message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tbody>
                    <tr>
                    <td align='center'>
                    <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left: 20px;margin-right: 20px;border-left: 1px solid #edc9bc;border-right: 1px solid #edc9bc;border-top: 2px solid #f05f2b;'>
                    <tbody>
                    <tr>
                    <td height='35'></td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='".$imagePath."'/></td>
                    </tr>
                    <tr>
                    <td height='35'></td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello ".$first_name.",</td>
                    </tr>
                    <tr>
                    <td height='10'></td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>
                    Welcome to <strong style='font-weight:bold;'>PICD Staffing!</strong>.
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    <tr>
                    <td align='center'>
                    <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left: 20px;margin-right: 20px;border-left: 1px solid #edc9bc;border-right: 1px solid #edc9bc;border-bottom: 2px solid #f05f2b;'>
                    <tbody>
                    <tr>
                        <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'>
                        Username: ".@$ssn_number." OR ".@$email."<br/>
                        Password: ".$phone."
                        </td>
                        </tr>
                    <tr>
                    <td height='10'></td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>
                        Please click the button below to login your account!
                    </td>
                    </tr>
                    <tr>
                    <td height='10'></td>
                    </tr>

                    <tr>
                    <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'>
                    <a href=".$url." target='_blank' style='background:#F05F2B;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Log In</a>
                    </td>
                    </tr>
                    <tr>
                    <td height='10'></td>
                    </tr>
                    <tr>
                    <td height='30'></td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>
                    Thank you!
                    </td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>
                    Sincerely
                    </td>
                    </tr>
                    <tr>
                    <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>
                    Team PICD Staffing
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>";

            $mail = new PHPMailer(true);

            try {

                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('no-reply@goigi.com', 'PICD Staffing');
                $mail->AddAddress($email);
                $mail->IsHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                //Send email via SMTP
                $mail->IsSMTP();
                $mail->SMTPAuth   = true;
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPSecure = 'tls';
                $mail->Host       = "smtp.gmail.com";
                $mail->Port       = 587;
                $mail->Username   = "no-reply@goigi.com";
                $mail->Password   = "wj8jeml3eu0z";
                $mail->send();
                // echo 'Message has been sent';
                $msg = 'New user created successfully. Email has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $msg = 'New user created. Message could not be sent. Mailer Error: {$mail->ErrorInfo}';
            }

            return response()->json([
                'result' => [
                    'status' => '1',
                    'message' => 'Data saved successfully!'
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Fail'
            ], 400);
        }
    }

    public function storeLists(Request $request, $activity_id)
    {
    	$item_name = $request->input('item_name');

    	$item = User::create([
    		'item_name' => $item_name,
    		'activity_id' => $activity_id,
    		'status' => 0
    	]);

    	if ($item) {
    		return response()->json([
                'data' => [
                    'type' => 'activity items',
                    'message' => 'Success',
                    'id' => $item->id,
                    'attributes' => $item
                ]
            ], 201);
    	} else {
    		return response()->json([
                'type' => 'activity_items',
                'message' => 'Fail'
            ], 400);
    	}
    }


    public function propertyType()
    {
    	$list = DB::table('property_types')->where('status', '1')->orderBy('id','asc')->get();

        $list = $this->removeNull($list);

    	return response()->json([
    		'result' => $list
    	], 200);
    }

    public function list()
    {
    	// $list = Listings::where('listing_status', '1')->orderBy('id','desc')->paginate(50)->toArray();

        $list = DB::table('listings')
            ->leftJoin('listing_galleries', 'listing_galleries.listing_id', '=', 'listings.id')
            ->select(DB::raw('listings.*, listing_galleries.filename'))
            ->where('listings.listing_status', '1')
            ->groupBy('listings.id')
            ->paginate(50);

        $list = $this->removeNull($list);

    	return response()->json([
    		'result' => $list
    	], 200);
    }

    public function activityUpdate(Request $request, $activity_id)
    {
    	$activity = User::find($activity_id);

    	if ($activity) {
    		$activity->activity_name = $request->input('activity_name');
    		$activity->save();

    		return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Update Success',
                    'id' => $activity->id,
                    'attributes' => $activity
                ]
            ], 201);
    	} else {
    		return response()->json([
                'type' => 'activities',
                'message' => 'Not Found'
            ], 404);
    	}
    }

    public function itemUpdate(Request $request, $activity_id, $item_id)
    {
    	$item = User::where('activity_id', $activity_id)->where('id', $item_id)->first();

    	if ($item) {
    		$item->item_name = $request->input('item_name');
    		$item->status = $request->input('status');
    		$item->save();

    		return response()->json([
                'data' => [
                    'type' => 'items',
                    'message' => 'Update Success'
                ]
            ], 201);
    	} else {
    		return response()->json([
                'type' => 'items',
                'message' => 'Not Found'
            ], 404);
    	}
    }

    public function getActivityById($activity_id)
    {
    	$activity = User::with('items')->find($activity_id);

    	if ($activity) {
    		return response()->json([
                'data' => [
                    'type' => 'activities',
                    'message' => 'Success',
                    'attributes' => $activity
                ]
            ], 200);
    	} else {
    		return response()->json([
                'type' => 'activities',
                'message' => 'Not Found'
            ], 404);
    	}
    }

    public function activityDestroy($activity_id)
    {
        $activity = User::find($activity_id);

        if ($activity) {
            $activity->delete();

            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'activities',
                'message' => 'Not Found'
            ], 404);
        }
    }

    public function activityItemDestroy($activity_id, $item_id)
    {
        $item = User::where('activity_id', $activity_id)->where('id', $item_id)->first();

        if ($item) {
            $item->delete();

            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'items',
                'message' => 'Not Found'
            ], 404);
        }
    }

    public function removeNull($array)
    {
        array_walk_recursive($array, function (&$array, $key) {
            $array = (null === $array) ? '' : $array;
        });

        return $array;
    }

    public function generate_otp($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function singleArray($parentArray)
    {
        $singleArray = [];
        foreach ($parentArray as $childArray) {
            foreach ($childArray as $value) {
                $singleArray[] = $value;
            }
        }

        return $singleArray;
    }

    public function random_strings($length_of_string)
    {
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
}
