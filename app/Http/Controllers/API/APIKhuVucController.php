<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ban;
use App\Models\KhuVuc;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIKhuVucController extends Controller
{
    public function layData(Request $request)
    {
        $data = KhuVuc::get();
        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            KhuVuc::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm Khu Vực mới!',
            ]);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $khu_vuc = KhuVuc::find($request->id);
            if ($khu_vuc) {
                $data = $request->all();
                $khu_vuc->update($data);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Khu Vực',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Cập nhật thất bại, Kiểm tra lại Khu Vực!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            $khu_vuc = KhuVuc::find($request->id);
            if ($khu_vuc) {
                $khu_vuc->delete();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Khu Vực!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Khu Vực!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function status(Request $request)
    {
        DB::beginTransaction();

        try {
            $khu_vuc = KhuVuc::find($request->id);
            if ($khu_vuc) {
                if ($khu_vuc->tinh_trang == 1) {
                    $check = Ban::where('id_khu_vuc', $request->id)
                        ->where('tinh_trang', \App\Models\Ban::BAN_DA_DAT)
                        ->first();
                    if ($check) {
                        return response()->json([
                            'status'    => 0,
                            'message'   => 'Có Bàn đã đặt, không thể tắt!',
                        ]);
                    } else {
                        Ban::where('id_khu_vuc', $request->id)->delete();

                        $khu_vuc->tinh_trang = 0;
                        $khu_vuc->save();

                        DB::commit();

                        return response()->json([
                            'status'    => 1,
                            'message'   => 'Đã thay đổi trạng thái Khu Vực!',
                        ]);
                    }
                } else {
                    for ($i = 1; $i <= $khu_vuc->so_ban; $i++) {
                        Ban::create([
                            'ten_ban'       => $i,
                            'id_khu_vuc'    => $khu_vuc->id,
                            'tinh_trang'    => \App\Models\Ban::BAN_SAN_SANG,
                        ]);
                    }

                    $khu_vuc->tinh_trang = 1;
                    $khu_vuc->save();

                    DB::commit();

                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã thay đổi trạng thái Khu Vực!',
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Khu Vực không tồn tại!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $nhan_vien =KhuVuc::find($request->id);
            if($nhan_vien){
                $nhan_vien->delete();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Nhân Viên!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Nhân Viên!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
