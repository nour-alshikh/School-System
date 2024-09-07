<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guardian\StoreGuardianRequest;
use App\Http\Resources\GuardianResource;
use App\Models\BloodType;
use App\Models\FatherInfo;
use App\Models\Guardian;
use App\Models\GuardiansAttachment;
use App\Models\MotherInfo;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::with(['mother_info', 'father_info'])->get();
        return response()->json([
            'guardians' => GuardianResource::collection($guardians),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuardianRequest $request)
    {

        $request->validated();
        try {
            DB::beginTransaction();

            $guardian =  Guardian::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            FatherInfo::create([
                'name'
                => [
                    'en' => $request->f_name["en"],
                    'ar' => $request->f_name["ar"]
                ],

                'national_id' => $request->f_national_id,
                'passport_id' => $request->f_passport_id,
                'phone' => $request->f_phone,
                'address' => $request->f_address,
                'job' => [
                    'en' => $request->f_job["en"],
                    'ar' => $request->f_job["ar"]
                ],

                'blood_type_id' => $request->f_blood_type_id,
                'nationality_id' => $request->f_nationality_id,
                'religion_id' => $request->f_religion_id,
                'guardian_id' => $guardian->id
            ]);

            MotherInfo::create([
                'name'
                => [
                    'en' => $request->m_name["en"],
                    'ar' => $request->m_name["ar"]
                ],

                'national_id' => $request->m_national_id,
                'passport_id' => $request->m_passport_id,
                'phone' => $request->m_phone,
                'address' => $request->m_address,
                'job' => [
                    'en' => $request->m_job["en"],
                    'ar' => $request->m_job["ar"]
                ],

                'blood_type_id' => $request->m_blood_type_id,
                'nationality_id' => $request->m_nationality_id,
                'religion_id' => $request->m_religion_id,
                'guardian_id' => $guardian->id
            ]);

            if (!empty($request->attachments)) {
                foreach ($request->attachments as $attachment) {

                    $attachment->storeAs($request->email, $attachment->getClientOriginalName(), $disk = "guardians_attachments");

                    GuardiansAttachment::create([
                        'file_name' => $attachment->getClientOriginalName(),
                        'guardian_id' => $guardian->id,
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => "Guardian Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian)
    {
        return response()->json([
            'guardians' => new GuardianResource($guardian),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $validator = Validator::make($request->all(), [
            'email' => "email|nullable|unique:guardians,email," . $request->id,

            'f_name' => "array|nullable",
            'f_name.*' => "string",
            'password' => "nullable",
            'f_national_id' => "nullable|string|min:10|max:10|unique:father_infos,national_id," . $request->id,
            'f_passport_id' =>
            "nullable|string|min:10|max:10|unique:father_infos,passport_id," . $request->id,
            'f_phone' => "string|nullable",
            'f_address' => "string|nullable",
            'f_job' => "array|nullable",
            'f_job.*' => "string",
            'f_blood_type_id' => "nullable|string|exists:blood_types,id",
            'f_nationality_id' => "nullable|string|exists:nationalities,id",
            'f_religion_id' => "nullable|string|exists:religions,id",


            'm_name' => "array|nullable",
            'm_name.*' => "string",
            'm_national_id' =>
            "nullable|string|min:10|max:10|unique:mother_infos,national_id," . $request->id,
            'm_passport_id' =>
            "nullable|string|min:10|max:10|unique:mother_infos,passport_id," . $request->id,
            'm_phone' => "string|nullable",
            'm_address' => "string|nullable",
            'm_job' => "array|nullable",
            'm_job.*' => "string",
            'm_blood_type_id' => "nullable|string|exists:blood_types,id",
            'm_nationality_id' => "nullable|string|exists:nationalities,id",
            'm_religion_id' => "nullable|string|exists:religions,id",
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $guardian->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $father_info = FatherInfo::where('guardian_id', $request->id)->first();

        $mother_info = MotherInfo::where('guardian_id', $request->id)->first();


        $father_info->update([
            'name' => [
                'en' => $request->f_name["en"] ?? "",
                'ar' => $request->f_name["ar"] ?? ""
            ],
            'national_id' => $request->f_national_id  ?? "",
            'passport_id' => $request->f_passport_id  ?? "",
            'phone' => $request->f_phone  ?? "",
            'address' => $request->f_address  ?? "",
            'job' => [
                'en' => $request->f_job["en"] ?? "",
                'ar' => $request->f_job["ar"] ?? ""
            ],
            // 'blood_type_id' => $request->f_blood_type_id  ?? null,
            // 'nationality_id' => $request->f_nationality_id  ?? null,
            // 'religion_id' => $request->f_religion_id  ?? null,
        ]);

        $mother_info->update([
            'name'  => [
                'en' => $request->m_name["en"] ?? "",
                'ar' => $request->m_name["ar"] ?? ""
            ],

            'national_id' => $request->m_national_id ?? "",
            'passport_id' => $request->m_passport_id ?? "",
            'phone' => $request->m_phone ?? "",
            'address' => $request->m_address ?? "",
            'job' => [
                'en' => $request->m_job["en"] ?? "",
                'ar' => $request->m_job["ar"] ?? ""
            ],

            // 'blood_type_id' => $request->m_blood_type_id ?? null,
            // 'nationality_id' => $request->m_nationality_id ?? null,
            // 'religion_id' => $request->m_religion_id ?? null,

        ]);

        return response()->json([
            'status' => 201,
            'message' => "Guardian Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return response()->json([
            'status' => 200,
            'message' => "Guardian Deleted Successfully"
        ]);
    }

    public function getNationalities()
    {
        $nationalities = Nationality::get();
        return response()->json([
            'nationalities' => $nationalities,
        ]);
    }
    public function getReligions()
    {
        $religions = Religion::get();
        return response()->json([
            'religions' => $religions,
        ]);
    }
    public function getBloodTypes()
    {
        $bloodTypes = BloodType::get();
        return response()->json([
            'bloodTypes' => $bloodTypes,
        ]);
    }
}
