<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{ProfileCategory,Category_Question,CategoryAnswer};
class SystemProfileController extends Controller
{
    public function getProfileData(Request $request)
    {
       //$dataArray = ProfileCategory::with('Category_Question.CategoryAnswer')->get();
       $profileCategoryArray = ProfileCategory::where('parent_id',0)->get();
       foreach($profileCategoryArray as $val)
       {
                $dataArray[] = array(
                    "categor_id"=>$val->id,
                    "category_name"=>$val->category_name,
                    "page"=>$val->page,
                    "category_question"=>$this->getCategoryQuestion($val->id),
                );  
        }
            if(!empty($dataArray))
            {
              $status = 200;
              $data = array(
                'success' => true,
                'message' => 'Profile data',
                'data' => $dataArray,
              );
             }
            else
            {
              $status = 500;
              $data = array(
                'success' => false,
                'message' => 'Something went wrong',
                'data' => [],
              );
            }
            return response()->json($data,$status);
    }

    public function getCategoryQuestion($id)
    {
        $result = Category_Question::where('category_id',$id)->get();
        $i=0;
        if($result != '' && $result != null)
        {
            foreach ($result as $row)
            {
                $data [$i]['question_id'] = $row->id;
                $data [$i]['question'] = $row->question;
                $data [$i]['hasChield'] = $this->hasChield($row->category_id,$row->question);
                $data [$i]['upto'] = $row->upto;
                $data [$i]['sortOrder'] = $row->sortOrder;
                $data [$i]['category_answer'] = $this->getCategoryAnswer($row->id);
                $i++;
            }
        }
        return isset($data) ? $data : null;
    }

    public function getCategoryAnswer($id)
    {
        $result = CategoryAnswer::where('question_id',$id)->get();
        $i=0;
        if($result != '' && $result != null)
        {
            foreach ($result as $row)
            {
                $data [$i]['answer_id'] = $row->id;
                $data [$i]['category_id'] = $row->category_id;
                $data [$i]['question_id'] = $row->question_id;
                $data [$i]['answer_statement'] = $row->answer_statement;
                $i++;
            }
        }
        return isset($data) ? $data : null;
    }


    public function hasChield($id,$category)
    {
        $chieldData = ProfileCategory::where('parent_id',$id)->where('category_name',$category)->first();

        if(isset($chieldData))
        {
            $result = Category_Question::where('category_id',$chieldData->id)->get();
            $i=0;
            if($result != '' && $result != null)
            {
                foreach ($result as $row)
                {
                    $data [$i]['question_id'] = $row->id;
                    $data [$i]['question'] = $row->question;
                    $data [$i]['upto'] = $row->upto;
                    $data [$i]['sortOrder'] = $row->sortOrder;
                    $data [$i]['category_answer'] = $this->getCategoryAnswer($row->id);
                    $i++;
                }
            }
            return isset($data) ? $data : null;
        }
        
        
    }


}
?>