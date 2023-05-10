<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'category';
        return view('category',$data);
    }

    public function categoryTableList()
    {
        $query['data'] = Category::orderBy('id','desc')->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditCategory(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->input('category_name');
        $data->page = $request->input('page');
        if($request->input('id') >0)
        {
            $update = Category::where('id',$request->input('id'))->update([
                'category_name' => $request->input('category_name'),
                'page' => $request->input('page'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Category successfully updated');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
        else
        {
            $data->save();
            Category::where('id',$data->id)->update([
                'enc_id' => md5($data->id),
            ]);
            if($data->save() > 0){
                $arr = array( "sucesss"=>'200' ,'message' => 'Category successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteCategoryAction(Request $request)
        {
        $query=Category::where('id',$request->input('id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Category successfully deleted'); 
        }
        else
        {
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }
}
?>