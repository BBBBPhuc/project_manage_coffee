<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ban;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIBanController extends Controller
{
    public function layData(Request $request)
    {
        $data = Ban::get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $ban = Ban::find($request->id);
            if($ban){
                $xxx = $request->all();
                $ban->update($xxx);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Bàn!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bàn không tồn tại!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $ban = Ban::find($request->id);
            if($ban){
                $ban->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Bàn!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bàn không tồn tại!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
