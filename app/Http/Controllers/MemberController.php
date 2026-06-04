<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Member;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/members/{id}",
     *     summary="Get member by ID",
     *     tags={"Members"},
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Member ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Member retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Member retrieved successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Veraldo"),
     *                 @OA\Property(property="email", type="string", example="veraldo@email.com"),
     *                 @OA\Property(property="phone", type="string", example="08123456789"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="joined_at", type="string", example="2026-01-01"),
     *                 @OA\Property(property="expired_at", type="string", example="2027-01-01")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Member not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Member not found"),
     *             @OA\Property(property="errors", type="null")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="API Key missing",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="API Key missing"),
     *             @OA\Property(property="errors", type="null")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return ApiResponse::error('Member not found', null, 404);
        }

        return ApiResponse::success($member, 'Member retrieved successfully');
    }

    /**
     * @OA\Get(
     *     path="/api/v1/members/{id}/status",
     *     summary="Get member status",
     *     tags={"Members"},
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Member ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Member status retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Member status retrieved successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="active")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Member not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Member not found"),
     *             @OA\Property(property="errors", type="null")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="API Key missing",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="API Key missing"),
     *             @OA\Property(property="errors", type="null")
     *         )
     *     )
     * )
     */
    public function status($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return ApiResponse::error('Member not found', null, 404);
        }

        return ApiResponse::success([
            'id'     => $member->id,
            'status' => $member->status,
        ], 'Member status retrieved successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/v1/members",
     *     summary="Create new member",
     *     tags={"Members"},
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email"},
     *             @OA\Property(property="name", type="string", example="Veraldo"),
     *             @OA\Property(property="email", type="string", example="veraldo@email.com"),
     *             @OA\Property(property="phone", type="string", example="08123456789"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="joined_at", type="string", example="2026-01-01"),
     *             @OA\Property(property="expired_at", type="string", example="2027-01-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Member created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Member created successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Veraldo"),
     *                 @OA\Property(property="email", type="string", example="veraldo@email.com"),
     *                 @OA\Property(property="phone", type="string", example="08123456789"),
     *                 @OA\Property(property="status", type="string", example="active"),
     *                 @OA\Property(property="joined_at", type="string", example="2026-01-01"),
     *                 @OA\Property(property="expired_at", type="string", example="2027-01-01")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="API Key missing",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="API Key missing"),
     *             @OA\Property(property="errors", type="null")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string',
            'email'      => 'required|email|unique:members,email',
            'phone'      => 'nullable|string',
            'status'     => 'nullable|in:active,inactive,suspended',
            'joined_at'  => 'nullable|date',
            'expired_at' => 'nullable|date',
        ]);

        $member = Member::create($validated);

        return ApiResponse::success($member, 'Member created successfully', null, 201);
    }
}