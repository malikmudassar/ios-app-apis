<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{ProfileCategory,Category_Question,CategoryAnswer};
use DB;
class SystemProfileController extends Controller
{
    public function getProfileData(Request $request)
    {
       //$dataArray = ProfileCategory::with('Category_Question.CategoryAnswer')->get();
       $profileCategoryArray = ProfileCategory::where('parent_id',0)->get();
       foreach($profileCategoryArray as $val)
       {
                $dataArray[] = array(
                    "id"=>$val->enc_id,
                    "pageTitle"=>$val->category_name,
                    "pageIcon"=>null,
                    "pageNo"=>$val->page,
                    "question"=>$this->getCategoryQuestion($val->id),
                );  
        }
            if(!empty($dataArray))
            {
              $status = 200;
              $data = array(
                'success' => true,
                'message' => 'Profile data',
                'attractions' => DB::table('attractions')->select('attraction_id','attraction as title')->get(),
                'purposes' => DB::table('purposes')->select('purpose_id','purpose as title')->get(),
                'occupations' => DB::table('occupations')->select('occupation_id','occupation as title')->get(),
                'questions' => $dataArray,
              );
             }
            else
            {
              $status = 500;
              $data = array(
                'success' => false,
                'message' => 'Something went wrong',
                'questions' => [],
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
                $data [$i]['id'] = $row->enc_id;
                $data [$i]['title'] = $row->question;
                $data [$i]['sortOrder'] = $row->sortOrder;
                $data [$i]['pickUpTo'] = $row->upto;
                $data [$i]['addButton'] = $row->addButton;
                $data [$i]['subSection'] = $this->hasChield($row->category_id,$row->question);
                $data [$i]['options'] = $this->getCategoryAnswer($row->id);
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
                $data [$i]['id'] = $row->enc_id;
                // $data [$i]['category_id'] = $row->category_id;
                // $data [$i]['question_id'] = $row->question_id;
                $data [$i]['title'] = $row->answer_statement;
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
                    $data [$i]['id'] = $row->enc_id;
                    $data [$i]['title'] = $row->question;
                    $data [$i]['sortOrder'] = $row->sortOrder;
                    $data [$i]['pickUpTo'] = $row->upto;
                    $data [$i]['addButton'] = $row->addButton;
                    $data [$i]['subSection'] = $this->hasChield($row->category_id,$row->question);
                    $data [$i]['options'] = $this->getCategoryAnswer($row->id);
                    $i++;
                }
            }
            return isset($data) ? $data : null;
        }
        
        
    }


}
?>