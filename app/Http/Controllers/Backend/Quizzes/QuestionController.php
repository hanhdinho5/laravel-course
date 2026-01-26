<?php

namespace App\Http\Controllers\Backend\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Exception;

class QuestionController extends Controller
{
    /**
     * Hiển thị danh sách câu hỏi của một quiz cụ thể
     */
    public function index($quizId)
    {
        // dd(1);
        $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));
        $question = Question::where('quiz_id', $quiz->id)->get();

        return view('backend.quiz.question.index', compact('quiz', 'question'));
    }

    /**
     * Hiển thị form tạo mới câu hỏi cho quiz
     */
    public function create($quizId)
    {
        $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));
        return view('backend.quiz.question.create', compact('quiz'));
    }

    /**
     * Lưu câu hỏi mới
     */
    public function store(Request $request, $quizId)
    {
        try {
            $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));
            // dd(encryptor('encrypt', $quiz->id));
            $question = new Question();
            $question->quiz_id = $quiz->id;
            $question->type = $request->questionType;
            $question->content = $request->questionContent;
            $question->option_a = $request->optionA;
            $question->option_b = $request->optionB;
            $question->option_c = $request->optionC;
            $question->option_d = $request->optionD;
            $question->explain = $request->explain;

            $question->correct_answer = $request->correctAnswer;

            if ($question->save()) {
                $this->notice::success('Lưu dữ liệu thành công!');
                return redirect()->route('quiz.question.index', $quizId);
            } else {
                $this->notice::error('Vui lòng thử lại');
                return redirect()->back()->withInput();
            }
        } catch (Exception $e) {
            dd($e);
            $this->notice::error('Vui lòng thử lại');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Hiển thị chi tiết một câu hỏi cụ thể
     */
    public function show($quizId, $id)
    {
        $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));

        $question = Question::findOrFail(encryptor('decrypt', $id));

        return view('backend.quiz.question.show', compact('quiz', 'question'));
    }

    /**
     * Hiển thị form chỉnh sửa câu hỏi
     */
    public function edit($quizId, $id)
    {
        $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));

        $question = Question::findOrFail(encryptor('decrypt', $id));

        return view('backend.quiz.question.edit', compact('quiz', 'question'));
    }

    /**
     * Cập nhật câu hỏi
     */
    public function update(Request $request, $quizId, $id)
    {
        try {
            $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));

            $question = Question::findOrFail(encryptor('decrypt', $id));

            $question->quiz_id = $quiz->id;
            $question->type = $request->questionType;
            $question->content = $request->questionContent;
            $question->option_a = $request->optionA;
            $question->option_b = $request->optionB;
            $question->option_c = $request->optionC;
            $question->option_d = $request->optionD;
            $question->explain = $request->explain;
            $question->correct_answer = $request->correctAnswer;

            if ($question->save()) {
                $this->notice::success('Cập nhật thành công!');
                return redirect()->route('quiz.question.index', $quizId);
            } else {
                $this->notice::error('Vui lòng thử lại');
                return redirect()->back()->withInput();
            }
        } catch (Exception $e) {
            dd($e);
            $this->notice::error('Vui lòng thử lại');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Xoá câu hỏi
     */
    public function destroy($quizId, $id)
    {
        $quiz = Quiz::findOrFail(encryptor('decrypt', $quizId));

        $data = Question::findOrFail(encryptor('decrypt', $id));

        if ($data->delete()) {
            $this->notice::error('Xoá dữ liệu thành công!');
        } else {
            $this->notice::error('Vui lòng thử lại');
        }

        return redirect()->route('quiz.question.index', $quizId);
    }
}
