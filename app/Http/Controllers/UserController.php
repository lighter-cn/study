<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Hobby;
use App\Models\Item;
use App\Models\Post;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;

class A {
    public $foo = 1;
}

class UserController extends Controller
{
    public function index ()
    {
        /*******************************
            配列
        *******************************/

        /* 配列演算子 */
            // 結合 : 両方の配列に存在するキーについては左側の配列の要素が優先され、 右側の配列にあった同じキーの要素は無視される。
            // $value = $value1 + $value2;

            // 同等(true / falseを返す) : キー/値のペアが等しい場合に true。
            // $value = $value1 == $value2;

            // 同一(true / falseを返す) : キー/値のペアが等しく、その並び順が等しく、 かつデータ型も等しい場合に true
            // $value = $value1 === $value2;

            // 等しくない
            // $value = $value1 != $value2;
            // $value = $value1 <> $value2;

            // 同一でない
            // $value = $value1 !== $value2;

        /* 配列関数 */
            // array_change_key_case(array $array, int $case = CASE_LOWER): array
            // arrayの全てのkeyを大文字もしくは小文字にした配列を返す

            // array_chunk(array $array, int $length, bool $preserve_keys = false): array
            // 配列を、要素数が、lengthの配列に分割。最後の部分はlengthより少なくなることもある
            // $preserve_keys をtrueで分割前のkeyをそのまま保持し、falseの場合は数字で振り直す。default = false

            // array_column(array $array, int|string|null $column_key, int|string|null $index_key = null): array
            // 入力配列から単一のカラムの値を返す

            // array_combine(array $keys, array $values): array
            // keys配列をkey、values配列をvalueをした配列を作成する
            // 互いの要素数が一致しない場合、エラーが発生する

            // array_count_values(array $array): array
            // 配列の値ごとの数を数える
            // string|int 以外の方の要素が登場するたびエラーが発生する。

            // array_diff_assoc(array $array,array ...$arrays): array
            // 追加された添字の確認を含めて配列の差を計算し、そのほかの配列のいずれにも含まれないものだけの残した配列を返す
            // つまり$arrayにはなく、$arraysの方にのみ含まれる値は差分として返さない
            // さらに言うと$arrayの各keyが他の配列に含まれ、そのvalueが一致しているかどうかで、異なっている、あるいはないものが返される。

            // array_diff_key(array $array, array ...$arrays): array
            // arrayのkeyをarraysのkeyと比較し、そのさを返す
            // arrayに存在し、arraysにないkeyのkeyとvalueの配列を返す。
            // keyが一致しているのであればvalueの違いはチェックしない

            // array_diff_uassoc(array $array, array ...arrays, callback $key_compare_func): array
            // コールバック関数を利用し、追加された添字の確認を含めて配列の差分を計算する
            // array_diff_assoc()と異なり内部関数ではなくユーザーが指定したコールバック関数を使って添字を比較する
            // 配列に比較対象に同様のkeyかつvalueであるもの以外を表示する

            // array_diff_ukey(array $array, array ...$arrays,callable $key_compare_func): array
            // arrayのkeyをarraysと比較しその差を返す
            // array_diff_key()と異なり内部関数ではなくユーザーが指定したコールバック関数を用いてindexを比較する

            // array_diff(array $array, array ...$arrays):array
            // arrayをarraysと比較し、arrayの要素の中で他の配列には存在しないものだけを返す。
            // keyの違いはチェックせず、あくまでvalueが比較する配列に含まれるかどうかのみの比較

            // array_fill_keys(array $keys, mixed $value): array
            // パラメータvalueで指定した値で配列を埋める。keysで指定した値をkeyとして使用する。

            // array_fill(int $start_index, int $count, mixed $value): array
            // valueを値をする配列をcountこのエントリからなる配列を埋める。その際keyはstart_indexパラメータから開始する
            // $value = array_fill(3, 5, "test");

            // array_filter(array $array,?callable $callback = null, int $mode = 0): array
            // callback関数によりフィルタ処理が行われたarrayの全ての要素を含む配列を返す。
            // modeでcallbackの引数に値のみか、keyのみか両方渡すかを指定できる。デフォルトは値のみ
            // $arr = array(“a”=>“apple”,“b”=>“banana”,“c”=>“cake”);
            // $result = array_filter($arr, function($value){
            //     return $value & 1;
            // }, ARRAY_FILTER_USE_KEY);
            // print_r($result);

            // array_flip(array $array):array
            // 配列のkeyと値を反転する
            // print_r(array_flip($arr));

            // array_intersect_assoc(array $array, array ...$arrays): array
            // 追加された添字の確認も含めて配列の共通項を確認する
            // つまり、keyとvalueの組み合わせが比較対象と一致するもののみの配列を返す。
            // print_r(array_intersect_assoc($arr1,$arr2));

            // array_intersect_key(array $array, array ...$arrays): array
            // keyが一致したkeyとvalueの配列を返す。
            // $arr1 = array(“a”=>“apple”,“b”=>“banana”,“c”=>“cake”,“d”=>“donat”);
            // $arr2 = array(“a”=>“apple”,“b”=>“banana”,“c”=>“case”,“e”=>“eringi”);
            // print_r(array_intersect_key($arr1, $arr2));

            // array_intersect_uassoc(array $array, array ...$arrays, callable $key_compare_func):array
            // keyとvalueがコールバック関数のチェックでtrueを返したもののみの配列を返す
            // $arr1 = array(“a”=>“apple”,“b”=>“banana”,“c”=>“cake”,“d”=>“donat”);
            // $arr2 = array(“a”=>“apple”,“B”=>“banana”,“c”=>“case”,“e”=>“eringi”);
            // print_r(array_intersect_uassoc($arr1, $arr2,"strcasecmp"));

            // array_intersect_ukey(array $array, array ...$arrays, callable $key_compare_func): array
            // keyのみがcallback関数のチェックでtrueを返したもののみの配列を返す。
            // $arr1 = array('red'=>1, 'blue'=>2, 'green'=>3);
            // $arr2 = array('red'=>1,'blue'=>3,'yellow'=>3);
            // $value = array_intersect_ukey($arr1, $arr2, function($key1, $key2){
            //     if($key1 == $key2){ return 0; }
            //     else if($key1 > $key2){ return 1;}
            //     else { return -1;}
            // });

            // array_intersect(array $array, array ...$arrays): array
            // arrayとarraysの値を比較して、存在する値の配列を返す
            // $arr1 = array('a'=>'red','blue','green');
            // $arr2 = array('b'=>'red','blue','yellow');
            // $value = array_intersect($arr1, $arr2);

            // array_key_exists(string $key, array $array): bool
            // keyが配列に存在するか真偽値で返す
            // $arr = array("red"=>1,"blue"=>2,"green"=>3);
            // $value = array_key_exists("yellow",$arr);

            // array_key_first(array $array): int|string|null
            // 配列の最初のキーを得る
            // $arr = array("red"=>1,"blue"=>2,"green"=>3);
            // $value = array_key_first($arr);

            // array_key_first(array $array): int|string|null
            // 配列の最後のキーを得る
            // $arr = array("red"=>1,"blue"=>2,"green"=>3);
            // $value = array_key_last($arr);

            // array_keys(array $array): array
            // array_keys(array $array, mixed $search_value, bool $strict = false): array
            // $arr = array(2 => 0, "color" => "red");
            // $value = array_keys($arr, "red");

            // array_map(?callable $callback, array $array, array ...$arrays): array
            // 指定した配列の要素にコールバック関数を適用する
            // $arr = array(1,2,3,4);
            // $value = array_map(function ($n){
            //     return ($n * $n * $n);
            // }, $arr);

            // array_merge_recursive(array ...$arrays): array
            // 一つ以上の配列を再帰的にマージする
            // 同じ文字列のkeyを有する値がある場合、その値は配列として一つにまとめられる。
            // $arr1 = array('a'=>'fire','blue','c'=>'green');
            // $arr2 = array('a'=>'red','blue','d'=>'yellow');
            // $value = array_merge_recursive($arr1,$arr2);

            // array_merge(array ...$arrays): array
            // 前の配列を後ろの配列に追加することにより複数の配列の要素をマージして得られた配列を返す。
            // 同じ文字列のkeyがある場合、後の配列の値となる。
            // $arr1 = array('a'=>'fire','blue','c'=>'green');
            // $arr2 = array('a'=>'red','blue','d'=>'yellow');
            // $value = array_merge($arr1,$arr2);

            // array_multisort(array &$array1,mixed $array1_sort_order = SORT_ASC, mixed $array1_sort_flags = SORT_REGULAR, mixed ...$rest): bool
            // 複数の配列を一度に、または多次元の配列をその次元の一つでソートする際に使用する
            // $arr1 = array(5,4,3,2,1);
            // $arr2 = array("e","d","c","b","a");
            // array_multisort($arr1, $arr2);
            // $value = $arr1;

            // array_pad(array $array, int $length, mixed $value): array
            // lengthで指定した長さになるように値valueで埋めたarrayのコピーを返す
            // lengthの長さよりも配列の長さが長い場合は埋める処理をしない
            // lengthに負の数を指定すると配列の左側を埋める
            // $arr = array("a"=>"apple","b"=>"bee","c"=>"car");
            // $value = array_pad($arr, 5, "d");

            // array_pop(array &$array): mixed
            // 配列から末尾の要素を取り除く
            // 返り値は末尾の値。元のarrayは末尾の要素が取り除かれた配列となる。
            // $arr = array("a"=>"apple","b"=>"bee","c"=>"car");
            // array_pop($arr);
            // $value = $arr;

            // array_product(array $array): int|float
            // 配列の積を返す
            // $arr = array(2,3,4,5);
            // $value = array_product($arr);

            // array_push(array &array, mixed ...$values): int
            // arrayをスタックとして処理し、渡された変数をarrayの最後に追加する
            // arrayの長さは渡された変数の数だけ増加する
            // 戻り値は配列の要素数
            // $arr = array("a","b");
            // array_push($arr, "c", "d");
            // $value = $arr;

            // array_rand(array $array, int $num= 1): int|string|array
            // 配列から一つ以上のkeyをランダムに取得する
            // 返り値はkeyを返す
            // $arr = array("a","b","c","d");
            // $value = array_rand($arr,2);

            // array_reduce(array $array, callable $callback, mixed $initial = null): mixed
            // コールバック関数を繰り返し配列に適用し、一つの値にまとめる
            // $arr = array(2,4,6,8,10);
            // $value = array_reduce($arr, function($carry, $item){
            //     $carry -=$item;
            //     return $carry;
            // });

            // array_replace_recursive(array $array,array ...$replacements): array
            // 渡された配列の要素を再帰的に置き換える
            // $base = array(
            //     "a" => array("aa" => "foo1", "ab" => "bar1"),
            //     "b" => array("ba" => "foo2", "bb" => "bar2"),
            //     "c" => array("ca" => "foo3", "cb" => "bar3"),
            // );
            // $replaced = array(
            //     "a" => array("aa" => "foo1", "ab" => "bar1"),
            //     "b" => "hoge",
            //     "d" => array("ca" => "foo3", "cb" => "bar3"),
            // );
            // $value = array_replace_recursive($base,$replaced);

            // array_replace(array $array, array ...$replacements): array
            // 渡された配列の要素を置き換える。
            // $base = array(1,2,3,4);
            // $replaced1 = array(1=>"a","b");
            // $replaced2 = array(2=>"A","B","C");
            // $value = array_replace($base, $replaced1,$replaced2);

            // array_reverse(array $array, bool $preserve_keys = false): array
            // 逆転した配列を返す
            // $arr = array("a" => 1, "b" => 2,"c" => 3);
            // $arr = array(4 => 1, 2, 3);
            // $value = array_reverse($arr);

            // array_search(mixed $needle, array $haystack, bool $strict = false): int|string|false
            // 指定した値を配列で検索し、見つかった場合に最初に対応するキーを返す
            // haystack内のneedleを検索する
            // strictをtrueにした場合、厳密な方比較を実行する
            // 返り値は、最初のkey、もしくは見つからなかった場合はfalseを返す。
            // $arr = array("A"=>"a","B"=>"C","D"=>"c","E"=>55,"F"=>0,"G"=>"a");
            // $value = array_search(false,$arr);

            // array_shift(array &$array): mixed
            // 配列の先頭から要素を一つ取り出して返す
            // 元の配列は一つ分短くなり、添字がしい時の場合、0から順に振りなおされる
            // $arr = array("A"=>"a","B"=>"b","C"=>"c");
            // $value = array_shift($arr);

            // array_slice(array $array, int $offset, ?int $length, bool $preserve_keys = false): array
            // 配列の一部を展開する
            // arrayからoffset及びlengthで指定された連続する要素を返す
            // offsetやlengthが負の数の場合、末尾から計算される
            // $arr = array("a","b","c","d","e");
            // $value = array_slice($arr,1,2,true);

            // array_splice(array &$array, int $offset, ?int $length, mixed $replacement = []): array
            // 配列の一部を削除し、他の要素で置換する
            // 戻り値は削除した要素
            // $arr1 = array("a","b","c","d");
            // $arr2 = array("x","y","z");
            // array_splice($arr1,2,1,$arr2);
            // $value = $arr1;

            // array_sum
            // 配列の中の値の合計を計算する
            // $arr = array(1,2,3,4,5,6,78,90);
            // $value = array_sum($arr);

            // array_udiff_assoc(array $array, array ...$arrays, callable $value_compare_func): array
            // データの比較にコールバックを用い、インデックスを含めて差を計算する
            // 元の配列にしか存在しないものや、元の配列と比較対象とで値がコールバックのチェックで差として出たもののみの配列を返す
            // $arr1 = array(1,3,5);
            // $arr2 = array(1,2);
            // $value = array_udiff_assoc($arr1, $arr2, function($a,$b){
            //     if ($a == $b) return 0;
            //     return $a > $b ? 1: -1;
            // });

            // array_udiff_uassoc(array $array, array ...$arrays, callable $value_compare_func, callable $key_compare_func): array
            // データと添字の比較にコールバック関数を用い、追加された添字の確認を含めて配列の差を計算する

            // array_udiff(array $array, array ...$arrays, callable $value_compare_func): array
            // データの比較にコールバック関数を用い、配列の差を計算する

            // array_uintersect_assoc
            // array_uintersect_uassoc
            // array_uintersect

            // array_unique(array, int $flags = SORT_STRING): array
            // 配列から重複した値を削除する。キーは最初の物が保持される。
            // $arr = array("a", "b", "c", "d", "c", "d");
            // $value = array_unique($arr);

            // array_unshift(array &$array, mixed ...$values): int
            // 一つ以上の要素を配列の最初に加える
            // $arr = array(3,4,5,6,7,8,9);
            // array_unshift($arr,0,1,2);
            // $value = $arr;

            // array_values(array $array): array
            // 数字添字の値の配列を返す
            $arr = array("a"=>"A","b"=>"B","c"=>"C");
            $value = array_values($arr);

            // array_walk_recursive
            // array_wark

            // array(mixed ...values): array
            // 配列を生成する

            // arsort(array &$array, int $flags = SORT_REGULAR): bool
            // 連想キーと要素との関係を維持しつつ配列を配列を降順にソートする
            // $arr = array("x"=>"X","y"=>"Y","z"=>"Z");
            // arsort($arr);
            // $value = $arr;

            // asort
            // compact
            // count
            // current
            // end
            // extract
            // in_array
            // key_exists
            // key
            // krsort
            // ksort
            // list
            // natcasesort
            // natsort
            // next
            // pos
            // prev
            // range
            // reset
            // rsort
            // shuffle
            // sizeof
            // sort
            // uasort
            // uksort
            // usort

        /* SQLクエリ */
        // $value = DB::select('select * from users where id = ?', [2]);
        // 名前付きバインディング
        // $value = DB::select('select * from users where id = :id', ['id' => 1]);
        // select
        // DB::insert('insert into hobbies (name) values (?)', ['music']);
        // update
        // DB::update('update hobbies set name = "piano" where name = ?', ['music']);
        // delete
        // DB::delete('delete from hobbies where id = ?',[5]);

        // トランザクション
        // DB::transaction(function() {
        //     DB::update('update users set name = "hoge"');
        // }, 5);

        // DB::beginTransaction();
        // DB::rollBack();
        // DB::commit();

        // $value = User::find(1);

        /* 1対1 */
        // 所持
        // $value = User::find(1)->role;
        // 所属
        // $value = Role::find(3)->user;

        /* 1対多 */
        // 所持
        // $value = Team::find(1)->users;
        // 所属
        // $value = User::find(1)->team;

        /* ofMany */
        // $value = Team::find(1)->latestUser;
        // $value = Team::find(1)->oldestUser;

        /* hasOneThrough */
        /* hasManyThrough */
        // $value = Team::find(1)->userRole;

        /* 多対多 */
        // $value = User::find(1)->hobbies;
        // 中間テーブルのカラムを取得
        // $value = Hobby::find(2)->users;

        /* ポリモーフィック リレーション 1対1 */
        // 所持
        // $value = Article::find(1)->post;
        // 所属
        // $value = Post::find(2)->postable;

        /* ポリモーフィック リレーション 1対多 */
        // 所持
        // $value = Article::find(1)->comments;
        // 所属
        // $value = Comment::find(1)->commentable;

        /* One of Many ポリモーフィック */

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'value' => $value
        ]);
    }

    public function other () {

        /* 変数

            変数 :
                データを保存するための入れ物
            変数宣言 :
                変数の名前とそこに格納できるデータ型を指定する行為
            初期化 :
                変数の宣言と同時に値を代入すること
            参照 :
                名前を指定して変数の値を取り出すこと
            説明変数名 :
                変数の名前がそのままコードの意味を表している変数

            変数名のルール :
                $変数名の形式であること
                名前の先頭には任意の文字か_しか使えない
                名前の２文字目以降は数字も使用できる
                大文字と小文字は区別される

            可変変数 :
                変数名を変数の値によって決めることのできる変数
                呼ぶべきクラスや関数を動的に変えることができる
        */

        /* sample */
            // 変数宣言
            // $123 = 1; -> syntax errorとなる
            // $_abc = "hoge"; -> OK
            // 下記の場合, okが表示される
            // $value = "ok";
            // $Value = "ng";

            // 可変変数
            // $test = 'value';
            // $value = 'flexible value';
            // $$test or ${$test} は $valueと同義

        /* ************************************************** */

        /* 定数

            定数 :
                途中で値の変えられないデータの入れ物
                マジックナンバー（見ただけで意味のわからない値）を避けたり、
                保守に強いコードにするためにも定数が用いられる
                PHPには定義済みの定数がある

            定数の宣言:
                const 定数名 = 値
                    トップレベル以外での宣言はできない
                    変数、関数の者りちを設定できない
                    実行速度はconstの方が早い
                define(定数名, 値)
                    クラス定数の宣言はできない

            定数のルール
                名前の先頭に$はつけない
                予約語は使用できない
                利用できる型は限られる。（整数、少数、文字列、真偽値、null、前述の値を含んだ配列）

        */

        /* sample */
            // const VALUE = 10; -> トップレベル以外では宣言できない(syntax errorになる)
            // define('VALUE',111); -> ok

            // defineのみ変数や関数の戻り値を設定できる
            // $value = "sample";
            // define('VALUE', $value);

            // 配列の定数を操作しようとするとerrorになる
            // define('VALUE', array(1,2,3,4,5));
            // array_pop(VALUE);

        /* ************************************************** */

        /* データ型

            データ型 :
                データの種類のこと
                静的型付け言語では変数の宣言時にデータ型も指定する
                PHPのような動的型付け言語では変数に対し、既存の値と異なる型を代入することができる
            スカラー型 :
                一つの変数で一つの値だけを扱うことができるデータ型の分類
            複合型 :
                一つの変数で複数のアタ尾をまとめて扱うデータ型の分類
            特殊型 :
                スカラー型 / 複合型のいずれにも分類できない特殊な値を表す型の分類
            リテラル :
                コードの中などに特定のデータ型の値を直に記したもの
                あるいはそのように書く際に定められている書式
        */

        /* sample */

            // 既存の値と異なる型を代入できる
            // $value = 1;
            // $value = array(1,2,3);
            // $value = "sample"; -> 最終的にこの値が代入される

        /* ************************************************** */

        /* 論理リテラル bool

            論理型 :
                スカラー型の一種で、真か偽のいずれかの状態しか持たない。
                true / falseというキーワードで表現する。（大文字小文字は区別しない）

            次の値を自動的にfalseとみなす
                空文字列、または文字列の0
                整数リテラルの0、-0
                要素数が0である空の配列
                null

            上記以外の値はtrueとみなされる


        */

        /* sample */
            // 以下のいずれもfalseとなる
            // $bool = false;
            // $bool = "";
            // $bool = "0";
            // $bool = 0;
            // $bool = -0;
            // $bool = array();
            // $bool = null;
            // if($bool == false){
            //     $value = 'false';
            // } else {
            //     $value = 'true';
            // }

        /* ************************************************** */

        /* 整数リテラル int
            整数リテラルの種類
                10進数リテラル
                 2進数リテラル
                 8進数リテラル
                16進数リテラル

            負数を表現するには-をつける
        */

        /* sample */
            // 10進数
                // $value = 10;
                // $value = -5;
            // 2進数
                // $value = 0b1001; -> 9
                // $value = 0b1002; -> syntax error
            // 8進数
                // $value = 0777; -> 511
                // $value = 0778; -> parse error
            // 16進数
                // $value = 0x2ea; ->746
                // $value = 0x2ez; -> syntac error

        /* ************************************************** */

        /* 浮動小数点リテラル float
            通常の小数点数
                ex) 1.142143
            指数表現
                ex)1.32e7 = 1.37*10^7(e以降は負の数も可能)
                指数関数の先頭の0は省略できる(.123e8など)

            数値セパレーター :
                数値リテラルの中に桁区切り文字として_を記述できる
                数値セパレータは10進数以外にも使える
                ただし、数値の先頭や末尾、小数点の隣、数値プレフィックスの途中には記載できない
        */

        /* sample */
            // 通常の場合
            // $value = 3.14;
            // 指数表現
            // $value = 1.23e5; -> 123000
            // 数値セパレータ
            // $value = 123_456;

        /* ************************************************** */

        /* 文字列リテラル
            文字列リテラルを表すにはは''or""で文字列を括る

            文字列に'や"が含まれる場合、文字列に含まれない方のクォーとで括る、もしくはエスケープする

            シングルクォートとダブルクォートの違い
                ダブルクォート文字列リテラルでは文字列内の変数を解釈し、その値を置き換える（変数展開 or 変数のパースという）
                ダブルクォート文字列リテラルではエスケープシーケンスを認識する
                原則として、基本的にはシングルクォートで文字列を括り、変数展開やエスケプシーケンスの利用などの意図がある時のみダブルクォートを使うのが好ましい

            エスケープシーケンス :
                タブや改行などの、文字列の中に機器の制御コードや通常は表記できない特殊な文字を混在させるために規定された特殊な記号や記法の組み合わせ

            ヒアドキュメント記法 :
                文字列リテラルを表す方法の一つ
                改行を含むような長い文字列を表すのに適している

                <<<EODからEOD;までを文字列リテラルとみなす
                EODは文字列の開始と終了を表すデリミタなので、開始と終了が同じであれば他の文字を使っても良い

                    <<<EOD   -> 変数の展開やエスケープを行う
                    <<<"EOD" -> 変数の展開やエスケープを行う（同上）
                    <<<'EOD' -> 変数の展開やエスケープを行わない -> NowDoc構文と呼ばれる

                ヒアドキュメント記法では終了文字列のインデント位置によって各行の先頭部分の空白が除去される

        */

        /* sample */
            // $value = 'sampel text';
            // 文字列にクォーとが含まれる場合
            // $value = "He's good person."; -> ok 異なる引用符で括る
            // $value = 'He\'s good person.'; -> ok エスケープ

            // 変数展開の違い
            // $name = "taro";
            // $value = "私は{$name}です"; -> result : 私はtaroです
            // $value = '私は{$name}です'; -> result : 私は{$name}です

            // エスケープシーケンスの違い
            // $value = "abc\tdef"; -> \tを水平タブとして認識する
            // $value = 'abc\tdef'; -> \tを文字として認識する

            // ヒアドキュメント記法
            // $name = "hanako";
            // $value = <<<EOD
            // Dear, {$name},
            // Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            // Repellat explicabo tempore quo excepturi saepe voluptate nihil praesentium a labore similique?
            // Ratione optio ducimus asperiores iste, velit laborum vero nesciunt suscipit!
            // EOD;

        /* ************************************************** */

        /* null

            ある変数が値を持たないことを表し、唯一のリテラルとしてnullを持つ

            次の条件で変数はnullとみなされる

                変数に値が代入されていない場合
                明示的にnullが代入された場合
                unset関数で変数の内容が破棄された場合

        */

        /* sample */
            // $value = null;

        /* ************************************************** */

        /* 配列

            複合型の一つ
            複数の値を収めることができる、仕切りのある入れ物のようなもの

            リテラル :
                $配列名 = [値, 値, 値, ...];
            インデックス / 添字 :
                配列などに格納された個々の要素を指し示す値などのこと

            連想配列 :
                数値キーの代わりに文字列キーを使って要素を管理できる

            多次元配列 :
                配列の中に配列を入れ子に格納したもの
                連想配列を含めることもできる
                インデックスが1つだけの場合は1次元配列
                配列の配列を2次元配列、またはより一般的に多次元配列という

            PHPでは数値をキーとする通常配列と文字列キーを持つ連想配列は区別されない

            PHPでは通常の数値をキーとする配列の場合、配列に要素を一つ追加すると最大のインデックス番号に+1したキーが割り振られる
            また、数値と文字列のキーは混在することができる。その際、キーを省略して追加すると、その時点での最大インデックス+1の値がキーとして割り振られる。

            キーの変換ルール
                整数として正しい文字列はそのまま整数値に変換される
                07のような10進数として妥当でない場合は文字列となる
                小数点は切り捨て
                true / false は 1 / 0 に変換される
                nullはから文字に変換される

        */

        /* sample */
            // リテラル
            // $array = ["a","b","c","d","e"];
            // 配列の個々の要素へのアクセス
            // $value = $array[2];
            // 末尾に追加する場合
            // $array[] = "f";
            // 特定の要素の値を書き換える場合
            // $array[0] = "A";

            // 連想配列
            // $array = ['a' => 'A', 'b' => 'B', 'c' => 'C'];
            // 連想配列へのアクセス
            // $value = $array['b'];

            // 多次元配列
            // $array = [
            //     [1,2,3],
            //     ['a','b','c'],
            //     ['A','B','C']
            // ];
            // 多次元配列へのアクセス
            // $value = $array[2][1]; -> Bを表示

            // 数値と文字列のキーの混在
            // $value = ['a' => 'A', 2 => 'B']; -> ok

            // $value = [
            //     'string' => 'a', // 'string'
            //     '2' => 'b',      // 2
            //     '03' => 'c',     // '03'
            //     4.4 => 'd',      // 4
            //     true => 'e',     // 1
            //     null => 'f'      // ''
            // ];

        /* ************************************************** */

        /* 型の相互変換

            暗黙的な型変換 :
                プログラムがその時々の状況に応じて値を適切なデータ型へ変換すること

            明示的な変換（キャスト） :
                値を特定の型に強制的に変換すること
                <構文> (データ型) 値

            利用可能なキャスト型

                (int) / (integer) -> 整数型へのキャスト
                (bool) / (boolean) -> 論理型へのキャスト
                (float) / (double) -> 浮動小数点型へのキャスト
                (string)           -> 文字列型へのキャスト
                (array)            -> 配列へのキャスト
                (binary)            -> バイナリ文字列へのキャスト
                (object)            -> オブジェクト型へのキャスト

                数値を文字列に変換する特殊な方法として変数をダブルクォートで括ることもできる

                文字列から数値にキャストする場合、二進数、八進数、十六進数は正しくキャストされない
                キャストする場合は bindec / octdec / hexdec 関数を使用する

        */

        /* sample */
            // $value = (string) 123; // -> 文字列'123'となる
            // $value = (array) 123; // -> 配列[0 => '123']となる
            // $value = (bool) 123; // -> 真偽値trueとなる

            // 数値を文字列に変換する
            // $value = 123;
            // dd("$value"); // stringの'123'となる

            // 二進数、八進数、十六進数のキャスト
            // $value = bindec('0b1011'); // 数値の11となる
            // $value = octdec('047');    // 数値の39となる
            // $value = hexdec('0x1fd');  // 数値の509となる

        /* ************************************************** */

        /* **************************************************
            演算子
        ************************************************** */

        /* 代数演算子

            代数演算子 :
                算術演算子ともいう、四則演算をはじめとする日常的な数学で利用する演算子

            +  : 和
            -  : 差
            *  : 積
            /  : 商
            %  : 剰余
            ** : 累乗
            ++ : 前方加算（代入前に加算）もしくは後方加算（代入後に加算）与えられたオペランドに対して1を加算する
            -- : 前方減算（代入前に減算）もしくは後方加算（代入後に減算）与えられたオペランドに対して1を減産する

            オペランド（非演算子） :
                演算の対象となる値や変数、定数などのこと
                これに加え、プログラム中の個々の命令・処理の対象となるデータやデータの所在情報のことを示すこともある

            マジカルインクリメント :
                加算演算子は末尾がアルファベットであれば次の文字へ変換するという特殊な処理を行う

            PHP7.4まで
                数値を含む文字列または数値のみの文字列は計算の際、暗黙的な型変換が行われて計算される。
                また、数値から始まる文字列は、数値が続く限り数値として認識される
                ex) '10' + '12abc' -> 22となる

            PHP8
                数字を含む文字列と計算を行う際、 A non-numeric value encountered となる

            配列の結合
                加算演算子は配列の加算（結合）もできる
                左の配列に存在しないキーの要素を右の配列から取り出し、左の配列に追加する

        */

        /* sample */
            // マジカルインクリメント
            // $value = "Z";
            // ++$value; // "AA"と表示される

            // 浮動小数点の演算は注意が必要
                // 8となるはずが7と出力される。内部的に二進数で演算されるために生まれる誤差が原因
                // $value = floor((0.1 + 0.7) * 10);

                // 任意精度数学関数を利用することで回避できる
                // $temp = bcadd(0.1, 0.7, 1);
                // $value = bcmul($temp, 10, 1); -> 8となる

            // 配列の加算
                // $array1 = ['a','b','c'];
                // $array2 = ['a','c','d'];
                // $value = $array1 + $array2; -> この場合、キーは全て同じなので$array1がそのまま表示される

                // $array1 = ['a' => 'A' ,'b' => 'B', 'c' => 'C'];
                // $array2 = ['a' => 'A' ,'b' => 'B', 'd' => 'D'];
                // $value = $array1 + $array2; -> この場合、['a'=>'A','b'=>'B','c'=>'C','d'=>'D']となる

        /* ************************************************** */

        /* 代入演算子
                代入演算子 :
                    左辺で指定した変数に対し、右辺の値を代入するための演算子

                複合代入演算子 :
                    代数演算子やビット演算子などの機能を合わせて提供する演算子

                =   : 値の代入
                +=  : 左辺と右辺を加算した結果を代入
                -=  : 左辺と右辺を減産した結果を代入
                *=  : 左辺と右辺を乗算した結果を代入
                **= : 左辺を右辺で累乗した結果を代入
                /=  : 左辺を右辺で除算した結果を代入
                %=  : 左辺を右辺で除算した余りを代入
                .=  : 左辺と右辺を連結した文字列を代入
                ??= : 左辺が非nullならその値を、nullなら右辺の値を代入
                &=  : 左辺と右辺をビット論理積した結果を代入
                |=  : 左辺と右辺とビット論理和した結果を代入
                ^=  : 左辺と右辺を排他的ビット論理和した結果を代入
                <<= : 左辺を右辺の値だけ左シフトした結果を代入
                >>= : 左辺を右辺の値だけ右シフトした結果を代入

                値による代入と参照による代入
                    変数は値を格納したメモリのアドレスに対してつけられた名札のようなもの
                    値による代入の場合、代入した変数と代入された変数は別物なので、
                    元の変数が変更されても代入された側の変数が影響を受けることはない

                    参照（リファレンス）による代入の場合は、メモリ上のアドレスそのものを引き渡す代入となる
                    そのため、元の変数と代入された側の変数が同じアドレスを見ているので、
                    元の変数を変更すると代入された側の変数にも影響が及ぶ
                    詐称による代入は = 演算子の後に参照を表す &演算子を指定する
                    ただし、オブジェクト型だけは例外で、参照による代入が既定となり、そもそもエラーとなる

                分割代入 :
                    配列/連想配列などを分解し、配下の要素を個々の変数に代入するための構文
                    list関数で代用することもできる

        */

        /* sample */
            // $value = 10;
            // $value += 5;
            // $value -= 3;
            // $value *= 2;
            // $value /= 6;
            // $value **= 2;
            // $value %= 7;
            // $value ??= 5;
            // $value &= 6;
            // $value |= 5;
            // $value ^= 12;
            // $value <<= 3;
            // $value >>= 2;

            // リファレンスによる代入
            // $a = 10;
            // $value = &$a;
            // $a = 3; // 参照先の値が変化したので $value = 3となる

            // $a = 10;
            // $value = $a;
            // $a = 3; // 参照による代入ではないので $value = 10 のまま

            // 分割代入
                // $array = [1,2,3,4];
                // [$a, $b, $c, $d] = $array; // $a = 1, $b = 2, $c = 3, $d = 4となる

                // 左辺の要素数が右辺と等しいか右辺より少なくないと警告が出る
                // $array = [1,2,3];
                // [$a, $b, $c, $d] = $array; // エラーになる

                // list関数を使った例
                // $array = ['hoge', 'fuga', 'foo', 'bar'];
                // list($a, $b, $c, $d) = $array; // $a = 'hoge', $b = 'fuga', $c = 'foo', $d = 'bar'となる

                // 一部の要素を切り捨てる
                // $array = ['hoge', 'fuga', 'foo', 'bar'];
                // [ , $a, ,$b] = $array; // $a = 'fuga', $b = 'bar' となり、'hoge'と'foo'は代入をスキップされる

                // 一部の要素だけを取得する
                // index値 => 変数 の形式で特定の要素だけを分割代入することも可能
                // $array = ['hoge', 'fuga', 'foo', 'bar'];
                // [0 => $a, 3 => $b, 2 => $c] = $array; // $a = 'hoge', $b = 'bar', $c => 'foo' となる

                // 連想配列から個々の要素を取り出すこともできる
                // $array = ['red' => 'apple', 'yellow' => 'banana', 'green' => 'lettuce'];
                // ['red' => $a, 'green' => $b] = $array; // $a = 'apple', $b = 'lettuce';

                // 配列、連想配列に関わらず、指定したキーがない場合はエラーになる
                // $array = ['hoge', 'fuga', 'foo', 'bar'];
                // [0 => $a, 3 => $b, 5 => $c] = $array; // $arrayに5のindexがないのでエラーになる

                // 入子の配列を分割する
                // $array = ['A', 'B', ['C', 'D', 'E']];
                // [$a, $b, $c] = $array; // $a = 'A', $b = 'B', $c = ['C', 'D', 'E'] となる
                // 連想配列でも可能
                // $array = ['id' => 1, 'info' => ['name' => 'tt', 'gender' => 'male']];
                // ['id' => $id, 'info' => ['name' => $name, 'gender' => $gender]] = $array; // $id = 1, $name = 'tt', $gender = 'male' となる

                // 分割代入を利用した変数のスワッピング
                // $x = 15;
                // $y = 17;
                // [$x, $y] = [$y, $x]; // 別の変数を使わずに$xと$yの値を入れ替えられる

        /* ************************************************** */

        /* 比較演算子

            比較演算子 :
                左辺と右辺を比較し、その結果をtrue/falseとして返す

            ==  : 左辺と右辺の値が等しい場合はtrue
            === : 左辺と右辺の値が等しく、かつ、同じデータ型の場合はtrue
            !=  : 左辺と右辺の値が等しくない場合にtrue
            <>  : 左辺と右辺の値が等しくない場合にtrue
            !== : 左辺と右辺の値が等しくない、または同じデータ型ではない場合にtrue
            <   : 左辺が右辺よりも小さい場合にtrue
            >   : 左辺が右辺よりも大きい場合にtrue
            <=  : 左辺が右辺以下の場合にtrue
            >=  : 左辺が右辺以上の場合にtrue
            <=> : 宇宙船演算子。左辺が右辺より小さい場合-1、等しい場合0、大きい場合1を返す
            ?:  : 条件演算子。条件式 ? 式1 : 式2 条件式がtrueの場合式1を返し、falseの場合、式2を返す
            ??  : null合体演算子。左辺がnullでなければその値、nullなら右辺の値、両方nullならnullを返す

            文字列混在の比較
                等価演算子==は数値と文字列を比較する時に文字列を数値に変換した上で比較しようとする
                また、文字列同士の比較であっても試位置形式の文字列である場合には数値に変換したものを比較しようとする

            浮動小数点の比較
                浮動小数点は内部的に二進数として扱われるため、注意が必要

            配列同士の比較
                配列同士の比較にも == / === / != / !== / <> / > / < / >= / <= 演算子を利用できる
                配列の比較順序 :
                    1. 要素数で比較
                    2. 要素数が等しい場合、同じキーを持つ要素同士でアタイの代償を比較（より大きい要素、小さい要素が見つかったところで判定終了）
                    3. 1と2で等しい場合は両者が等しいとみなす

                    ただし、2で左辺の配列が持つキーを右辺が持たなかった場合、比較は失敗する
        */

        /* sample */

            // $value = 10 ==  10; // true
            // $value = 0 ===  false; // false
            // $value = 10 !=  11; // true
            // $value = 10 <>  10; // false
            // $value = 1 !==  true; // true
            // $value = 1 < 2; // true
            // $value = 1 > 2; // false
            // $value = 1 <= 1; // true
            // $value = 1 >= 0; // true
            // $value = 1 <=> 2; // -1
            // $value = 1 < 2 ? 'yes' : 'no'; // yes
            // $value = 'not null' ?? 'null'; // not null

            // 等価演算子と厳密な等価演算子の比較
            // dd('314' == 3.14e2);  // true
            // dd('314' === 3.14e2); // false
            // dd('1' == 1);  // true
            // dd('1' === 1); // false

            // 浮動小数点を比較する時の例
            // define('EPSILON', 0.00001);
            // $x = 0.123456;
            // $y = 0.123455;
            // dd(abs($x - $y) < EPSILON);

            // 配列同士の比較
            // dd([1,2,3,4] == [1,2,3,4]);  // true
            // dd([1,2,3] != [1,2,3,4]);    // true
            // dd([1,2,3,4] <> [1,2,3]);    // true
            // dd([1,2,3,4] > [1,2,3]);     // true
            // dd([1,2,3,4] < [1,2,3]);     // false
            // dd([1,2,2] < [1,2,3]);       // true
            // dd([1,2,2] > [1,2,3]);       // false
            // dd([1,2,3] === [1,2,3]);      // true
            // dd([1,2,3] !== [1,2,'3']);    // true

            // 条件演算子
            // dd(true ? 'TRUE' : 'FALSE'); // trueならTRUEを返し、falseならFALSEを返す
            // dd('hoge' ?:'fuga');         // 省略形1。左の式がtrueなら左の式を、falseなら右の式を返す
            // dd('not null' ?? 'null');       // 省略形2。左の式がnullである場合、右の式を返す。それ以外は左の式を返す

        /* ************************************************** */

        /* 論理演算子
            論理演算子 :
                複数の条件式を論理的に結合し、その結果を true / false として返す

            &&  : 論理積
            and : 論理積
            ||  : 論理和
            or  : 論理和
            xor : 排他的論理和。いずれかがtrueで双方ともがtrueでない場合にtrue
            !   : 否定

            論理積と論理和が二つずつ用意されているのはそれぞれで優先順位が違うため

            ショートカット演算（短絡演算） :
                ある条件下では左式だけが評価され、右式が評価されない場合がある
                ex) 論理和で左式がfalseの場合、右式を評価しない
        */

        /* sample */
            // $x = 10;
            // dd($x >1 && $x < 11);   // true
            // dd($x < 1 || $x > 9);   // false
            // dd($x > 1 xor $x < 11); // false
            // dd(!($x == 9));         // true

            // ショートカット演算を利用したコードの記述例
            // $x = 1;
            // if($x != 2)dd('skip'); // if文の場合
            // $x == 2 or dd('skip'); // ショートカット演算を用いた書き方（結果は同じ）

        /* ************************************************** */

        /* ビット演算
            整数を二進数で表した時の各桁に対して論理計算を行う演算子

            &  : 論理積
            |  : 論理和
            ^  : 排他的論理和
            ~  : 否定（ビットを反転）
            << : ビットを左にシフト
            >> : ビットを右にシフト
        */

        /* その他の演算子
            文字列演算子
                左式と右式の文字を連結する
            実行演算子
                バッククォートで囲んだブロックをシェルコマンドととして実行する
            エラー制御演算子 (@)
                特定の式の先頭に付加することで、その命令で発生したエラ〜メッセージを抑制する
                式の先頭にだけつけられるので、制御ぶん、関数、クラスの定義の前に付与することはできない

        */

        /* sample */

            // 文字列演算子
                // dd('sample ' . 'text'); // output => 'sample text'
                // 文字列演算で数字と連結させた場合
                // dd(0xff . 1.5e2); // output => '255150'
                // 16進数や指数表現を文字のまま連結したい場合はシングルクォートで括る
                // dd('0xff' . '1.5e2'); // output => 'oxff1.5e2'

            // 実行演算子
                // dd(`ls -la`);

            // エラー制御演算子
                // $array = ['apple' => 'red'];

                // 存在しないキーのためエラーになる
                // dd($array['orange']); // Undefined array key "orange"

                // エラー制御演算子をつけると存在しないキーでもエラーにならない
                // dd(@$array['orange']); // null

        /* ************************************************** */

        /* 演算子の優先順位と結合法則
            優先順位
                <high>
                    clone, new
                    **
                    ++, --, ~, (int), (float), (string), (array), (object), (bool), @
                    instanceof
                    !
                    *, /, %
                    +, -, .
                    <<, >>
                    <, <=, >, >=
                    ==, !=, <>, ===, !===, <=>
                    &
                    ^
                    |
                    &&
                    ||
                    ??
                    ?:
                    =, +=, -=, *=, /=, **=, .=, %=, &=, |=, ^=, <<=, >>=, ??=
                    and
                    xor
                    or
                <low>

                *()で囲まれた指揮は最優先で処理されるので、うるさくならない範囲で積極的に利用すべき

            結合法則
                同じ優先順位の演算子を処理する順序

                左結合
                    算術演算子
                        *, /, %, +, -
                    ビット演算子
                        <<, >>, $, ^, |
                    論理演算子
                        &&, ||, and, xor, or
                    条件演算子
                        ?:
                    その他
                        .(文字列演算子), instanceof
                右結合
                    算術演算子
                        **
                    論理演算子
                        !
                    代入演算子
                        =, +=, -=, *=, **=, /=, .=, %=, &=, |=, ^=, <<=, >>=, ??=
                    その他
                        clone, ~, ??, (int), (float), (string), (array), (object), (bool), @
                非結合
                    比較演算子
                        <, <=, >=, <>, ==, !=, ===, !==, <=>
                    その他
                        new, ++, --
        */

        /* sample */
            // $x = 10;
            // $y = 4;
            // dd(2 * 3 + 1); // -> 7
            // dd(++$x * 2); // -> 22
            // dd($x += 5 * 2); // -> 20

        /* ************************************************** */

        /* **************************************************
            制御構文
        ************************************************** */

        /* 制御構文
            一般的にプログラムの構造は以下のように分類できる
                順次(順接) : 記述された順に処理を実行
                選択      : 条件によって処理を分岐
                反復      : 特定の処理を繰り返し実行

            構造化プログラミング :
                順次、選択、反復を組み合わせながらプログラムを組み立てる手法

        */

        /* ************************************************** */

        /* 条件分岐
            if (単純分岐) :
                与えられた条件式が true / false のいずれかによって実行すべき処理を分岐する命令。
                elseブロックは省略もできる

                    if(条件式){
                        処理
                    } else {
                        処理
                    }

            if (多岐分岐) :
                elseifブロックを利用することで、多岐分岐を表現することができる

                    if(条件式1){
                        処理
                    } elseif(条件式2) {
                        処理
                    } else {
                        処理
                    }

                if ~ elseifでは複数の条件に合致しても実行されるブロックは最初に合致した一つだけ

            ブロック :
                {}で囲まれた部分

            if命令は互いに入れ子にすることもできる（ネスト）

            if文の処理が一行の場合、{}を省略することができる
            ただし、中括弧を省略した場合、elseブロックは直近の命令に対応するため予期せぬ結果を生むことがあるので注意

            ネスト :
                あるものの中にそれと同じ形や種類のものが入っている状態や構造のこと

            Point :
                できる限り厳密等価演算子を使う(falsyな値に注意)
                条件式からはできるだけ否定(!)を取り除く

            falsyな値 :
                暗黙的にfalseとみなされる値

            ifをコメントアウトの用途で利用することもできる
                if (false) {
                    コメントアウトするコード
                }

                このように条件式が定数(リテラル)であるものを定数条件式とも言う
                通常の複数行コメントアウトと異なるメリットとして
                    - 複数行コメントを含んだコードもコメントアウトできる
                    - 定数値を変更するだけで有効/無効をまとめて切り替えられる
                ただし、乱用しすぎると見辛くなるので、限られた用途でのみ利用するのが良い

            switch (多岐分岐) :
                等価演算子による多岐分岐に特化した条件分岐

                switch(式){
                    case 値1 :
                        処理
                    case 値2 :
                        処理
                    default :
                        処理
                }

                switchの判定は===ではなく==で比較する点に注意が必要

                case句の最後にはbreak命令を指定しなければそのまま次の処理に行ってしまうため注意が必要
                break文を省略し、複数のcase句の処理を続けて実行することをフォロースルーという
                フォロースルーは極力避けるべきだが、or条件と同じ意味で複数のcaseを文を挟まずに列記する場合は例外とすることもある。

            match(php 8以降) :
                値を返すことのできるswitchの派生のような式

                match(式){
                    値1 => 式1,
                    値2 => 式2,
                    ...
                    default => 式N
                }

                default句は省略できるが、全ての値にマッチしない場合、エラーを返すのでdefaultを指定しておくことが推奨

                switchとの相違点 :
                    matchは厳密等価演算子===で比較する
                    ブロックを抜けるためのbreakは不要
                    =>の右辺には単一のしきもしくはユーザー定義関数を呼びだしても良い
                    =>の左辺には任意の指揮を指定できる（関数やメソッドなども呼び出し可能）
        */

        /* sample */
            // 単純分岐
                // $x = 10;
                // if($x == 10){
                //     dd($x);  // -> output
                // } else {
                //     dd('else');
                // }

            // 多岐分岐
                // $x = 100;
                // if ($x >= 100) {
                //     dd('$xは100以上'); // -> output
                // } elseif($x >= 10) {
                //     dd('$xは10以上');
                // } else {
                //     dd('$xは10未満');
                // }

            // 条件分岐のネスト
                // $x = 2;
                // $y = 0;
                // if ($x > 0) {
                //     if ($y > 0) {
                //         dd('$x > 0 && $y > 0');
                //     } else {
                //         dd('$x > 0 && $y <= 0'); // -> output
                //     }
                // } else {
                //     dd('$x <= 0');
                // }

            // {} を省略した場合の挙動
                // $x = 1;
                // $y = 0;
                // if ($x === 1)
                //     if ($y === 1)
                //         dd('here is skipped');
                // else
                //     dd('output');

            // switch文
                // $value = 'very good';
                // switch($value){
                //     case 'very good':
                //         dd('you are very good.');
                //         break;
                //     case 'good':
                //         dd('you are nice.');  // output
                //         break;
                //     default:
                //         dd('not good');
                //         break;
                // }

            // switch文の比較の注意点
                // $value = 1;
                // switch($value){
                //     case true:
                //         dd('true'); // == での比較のためこの条件と一致してしまう
                //         break;
                //     case 1:
                //         dd('1');
                //         break;
                //     default :
                //         dd('default');
                //         break;
                // }

            // match
                // $x = 'kanagawa';
                // $result = match($x){
                //         'tokyo' => 'nowhere',
                //         'saitama' => 'saitama',
                //         'kanagawa' => 'yokohama',
                //         default => '...'
                //     };
                // dd($result);

        /* ************************************************** */

        /* 繰り返し処理
            while / do ~ while
                与えられた条件式がtrueの間ループを繰り返す

                while(条件式){
                    処理
                }

                do {
                    処理
                } while (条件式);

                do ~ whileは文の区切りに;が必要な点に注意

                whileは前置判定、do ~ whileは後置判定のため、初めから条件が満たされない場合、whileは一度も処理を行わないが、
                do ~ whileは一度処理を行う

            繰り返し処理を記述する場合、無限ループにならないように注意する
            for
                あらかじめ指定された回数だけ処理を行う

                for(初期化式; 継続条件式; 増減式) {
                    処理
                }

                初期化式はカウンター変数(ループ変数)を初期化する
                カウンター変数はforによるループの回数を管理する変数のこと
                初回のループのみで実行される式

                継続条件式はループを継続するための条件を表す
                ループのたびに実行される式

                増減式はループないの処理が一回終わるたびにカウンター変数の増減を行う
                ループのたびに実行される式（ただし、二回目以降）

                注意点 :
                    カウンター変数に浮動小数点型を利用しない->誤差が生まれる可能性があるため
                    カウンター変数の操作をforのブロックの中で行わない->意図しない結果が生まれる可能性があるため

            カンマ演算子 :
                カンマ演算子を利用することで、初期化式、継続条件式、増減式に複数の式を指定することができる

            foreach
                指定された配列 / 連想配列の要素を取り出して先頭から順に処理する

                foreach(配列 as 値変数){
                    処理
                }

                foreach(連想配列 as キー変数 => 値変数){
                    処理
                }

                キー変数や値変数はまとめて仮変数とも呼ばれ、配列や連想配列から取り出した各要素のキー / 値を一時的に格納する変数

                値変数の参照渡しについて
                    foreachブロックの中で配列の要素を変更したい場合は値変数を参照渡しすることで可能
                    ただし、仮変数の変更はコードの見通しが悪くなりやすいので、array_mapを優先して利用した方が良い

                foreachで分割代入を利用することも可能

            ループの制御
                特定の条件を満たした場合、強制的にループを終了したり、スキップさせたい場合に利用できる制御命令

                break :
                    現在のループを強制的に中断するための命令
                    一般的に switch / while / do ~ while / for / foreach の中で利用できる

                continue :
                    現在の周回だけをスキップしループそのものは継続して実行する命令

                入れ子のループを脱出/スキップする
                    規定では最も内側のループに対しbreak / continueをする
                    break / continue ループ階層数; とすることで指定したループの階層に対し処理を行うこともできる
                    ただし階層よりも大きい値を指定した場合はエラーとなる

                switchの中でbreak / continueを扱う場合は注意が必要
                挙動の上では条件分岐だが、処理としては繰り返しとして扱われている
        */

        /* sample */
            // while
                // $i = 1;
                // while($i < 6) {
                //     var_dump($i);
                //     $i++;
                // }

            // do ~ while
                // do{
                //     var_dump($i);
                //     $i++;
                // }while($i < 6);

            // for
                // for($i = 0; $i < 6; $i++){
                //     var_dump($i);
                // }

            // カンマ演算子
                // for($i = 0; $i < 3; var_dump($i), $i++); // 一行でまとめる場合、最後に;が必要なことに注意

                // for($i = 1, $j = 2; $result = $i * $j, $i < 5; $i++, $j++){
                //     var_dump($result);
                // }

            // foreach
                // $array = ['a','b','c'];
                // foreach($array as $word){
                //     var_dump($word);
                // }

                // $array = ['tt' => 'male', 'mk' => 'female', 'mm' => 'male'];
                // foreach($array as $key => $value){ // 通常の配列でも$key => $valueの形で使うことができ、その場合$keyにはインデックス番号がセットされる
                //     $result = $value . ' : ' . $key;
                //     var_dump($result);
                // }

            // 仮引数を値参照にした場合のforeach
                // $array = ['a', 'b', 'c'];
                    // 値参照していないので元の配列は変化しない
                    // foreach($array as $value){
                    //     $value .= ':NEW';
                    // }
                    // var_dump($array); // $array = ['a', 'b', 'c']

                    // 値参照した場合は元の配列が変化する
                    // foreach($array as &$value){ // &を付けて直接参照にしている
                    //     $value .= ':NEW';
                    // }
                    // var_dump($array); // $array = ['a:NEW', 'b:NEW', 'c:NEW']

            // foreachの分割代入例
                // $array = [
                //     ['hoge', 28],
                //     ['fuga', 29],
                //     ['foo', 30]
                // ];
                // foreach($array as [$name, $age]){
                //     $text = 'Name : '. $name . ' / Age : ' . $age;
                //     var_dump($text);
                // }

                // $array = [
                //     ['name' => 'hoge', 'age' => 30],
                //     ['name' => 'fuga', 'age' => 31],
                //     ['name' => 'foo', 'age' => 32]
                // ];
                // foreach($array as ['name' => $name, 'age' => $age]){
                //     $text = 'Name : '. $name . ' / Age : ' . $age;
                //     var_dump($text);
                // }

                // 配列形式の変数への代入の例
                // $names = [];
                // foreach($array as $value){
                //     ['name' => $names[]] = $value;
                // }
                // var_dump($names);

            // break
                // $sum = 0;
                // for($i = 1;$i < 10;$i++){
                //     $sum += $i;
                //     if($sum > 32) { break; }
                // }
                // dd($i);

            // continue
            // $sum = 0;
            // for($i = 1; $i <= 10; $i++){
            //     if($i % 2 === 0){ continue; }
            //     $sum += $i;
            // }
            // dd($sum);

            // 入れ子のループでの break / continue
                // for($i = 1; $i < 10; $i++){
                //     for($j = 1; $j < 10; $j++){
                //         $result = $i * $j;
                //         if($result >= 40) { continue; }
                //         print $result . ',';
                //     }
                //     print '<br />';
                // }

                // 入れ子の外のループまで break / continue する場合
                // for($i = 1; $i < 10; $i++){
                //     for($j = 1; $j < 10; $j++){
                //         $result = $i * $j;
                //         if($result >= 40) { break 2; } // この場所を変更
                //         print $result . ',';
                //     }
                //     print '<br />';
                // }



        /* ************************************************** */

        /* 制御命令のその他
            goto命令
                スクリプトの処理を強制的に他に移動することができる命令
                事前に移動さきのラベルを指定する。

                goto ラベル名;

                ラベル名 :

                注意点
                    どこにでも移動できるわけではない
                    - 異なるファイル
                    - 関数やクラス、メソッドの中
                    ループの外側からループの内側
                    濫用すると既読性が下がる可能性がある（基本的に他の書き方ができるためできれば使わない）

            固定テンプレート / HTMLテンプレート :
                スクリプティングデリミタ(<?php ~ ?>)で囲まれていない、固定的なHTMLソース

            スクリプトブロック :
                スクリプティングデリミタ(<?php ~ ?>)で囲まれたコードブロック


            スクリプトブロックとHTMLテンプレートは入れ子にすることも可能
            PHPページにおける固定テンプレートとはprint命令と等価であると考えても良い
            そのためforループやその他の制御命令の途中でスクリプトブロックを区切ってその中にHTMLテンプレートを含んでも正しく実行される

            if,switch,while,for,foreachには処理を{}で囲む代わりに: ~  endif; / endswitch; / endwhile; / endfor; / endfoeach; で括ることもできる。
        */

        /* sample */
            // goto
                // for($i = 1; $i < 10; $i++){
                //     for($j = 1; $j < 10; $j++){
                //         $result = $i * $j;
                //         if($result > 40) { goto end; }
                //         print $result . ',';
                //     }
                //     print '<br />';
                // }
                // end :

            // {}を使わない制御構文の書き方
                // $x = 10;
                // if($x > 5):
                //     print 'greater than 5';
                // endif;

        /* ************************************************** */

        /* **************************************************
            組み込み関数
        ************************************************** */

        /* 関数
            関数 :
                何かしらの入力（パラメータ）を与えることで、あらかじめ決められた処理を行い、その結果を返す仕組みのこと
                関数への入力を引数、出力を戻り値という

            関数の呼び出し
                戻り値 = 関数名(引数, ...)

                二つ以上引数を受け取る場合は、カンマ区切りで記述する
                引数がない関数もあるが、その場合も()は省略できない
                また、戻り値を必要としない場合や戻り値を返さない関数の場合、 関数名(引数, ...) と記述しても良い

            組み込み関数(ビルトイン関数 / 内部関数) :
                PHPが標準で提供する関数
                組み込み関数には準備を特にすることなく利用できるコアの関数の他に、
                利用にあたってphp.iniでの設定やインストール時に明示的に組み込む必要があるものが存在する

            関数
                - 組み込み関数      : PHPに組み込まれた関数
                    - コア拡張     : コア組み込み（無効にすることはできない）
                    - バンドル拡張  : PHP標準でバンドル
                    - 外部拡張     : 利用には外部ライブラリの組み込みが必要
                    - PECL拡張     : PHP Extention Community Libraryで提供されるライブラリ
                - ユーザー定義関数   : 開発者が定義した関数
        */
        /* ************************************************** */

        /* 文字列関数
            文字列関数 :
                文字列の加工や整形、検索や取得など文字列の操作に広く関わる機能を提供
                標準の文字列関数と、日本語に対応したマルチバイト文字列関数がある

            マルチバイト文字 :
                2bite以上のデータで表現される文字のこと

            シングルバイト文字 :
                1biteで表現される英数字などの文字
        */

        /* sample */
            /*
                文字列の長さを取得
                mb_strlen(string $string [,?string $encoding]): int
                $string : 対象の文字列
                $encoding: 使用する文字エンコーディング
            */

                // $str = 'WINGSプロジェクト';
                // print mb_strlen($str);

            /*
                文字列を大文字<->小文字で変換
                mb_convert_case(string $string, int $mode [,?string $encoding]): string
                $string : 対象の文字列
                $mode : 変換モード
                    MB_CASE_UPPER : 小文字->大文字
                    MB_CASE_LOWER : 大文字->小文字
                    MB_CASE_TITLE : 先頭文字を大文字
                    MB_CASE_XXXXX_SIMPLE : 文字列長が変化しない変換(XXXXXはLOWER, UPPER, TITLE)
            */

                // $data1 = 'Wings project';
                // $data2 = 'ＷＩＮＧＳプロジェクト';
                // $data3 = 'Fußball';
                // print mb_convert_case($data1, MB_CASE_UPPER); // output 'WINGS PROJECT'
                // print mb_convert_case($data1, MB_CASE_LOWER); // output 'wings project'
                // print mb_convert_case($data1, MB_CASE_TITLE); // output 'Wings Project'
                // print mb_convert_case($data2, MB_CASE_LOWER); // output 'ｗｉｎｇｓプロジェクト'
                // print mb_convert_case($data3, MB_CASE_UPPER); // output 'FUSSBALL'
                // print mb_convert_case($data3, MB_CASE_UPPER_SIMPLE); // output 'FUßBALL'

            /*
                部分文字列を取得 1
                mb_substr(string $string, int $start [, ?int $length [,?string $encording]]): string
                $string : 任意の文字列
                $start : 取得開始位置
                $length : 取り出す文字数 / 省略した場合、末尾まで取得
                $encoding : 使用する文字エンコーディング / 省略した場合、default_charsetパラメータの値

                $start, $lengthに負数を指定した場合、末尾からの文字数を表すものとみなす

                文字列から特定の一文字を取り出すのであれば$str[4]のように記述できるが、マルチバイト文字には対応していない
            */

            // $str = 'あいうえおかきくけこ';
            // print mb_substr($str, 5, 2); // output 'かき'
            // print mb_substr($str, 5); // output 'かきくけこ'
            // print mb_substr($str, 5, -3); // output 'かき'
            // print mb_substr($str, -8, 2); // output 'うえ'

            /*
                部分文字列を取得 2
                mb_strstr(string $haystack, string $needle [,bool $before_needle = false [,?string $encoding]]) : string|false
                $haystack : 対象の文字列
                $needle : 検索文字列
                $before_needle : trueで検索文字列の前方取得、falseで後方を取得
                $encodint : 使用する文字エンコーディング

                引数$needleが見つからない場合はfalseを返す
            */

            // $str = 'あいうえおかきくけこ';
            // print mb_strstr($str, 'か', true); // output 'あいうえお'
            // print mb_strstr($str, 'う'); // output 'うえおかきくけこ'
            // print mb_strstr($str, 'く', false); // output 'くけこ'

            /*
                部分文字列を置換
                str_replace(string|array $search, string|array $replace, string|array $subject[,int &$count]) : string|array
                $search : 置き換える部分文字列
                $replace : 置き換え後の文字列
                $subject : 対象の文字列
                &$count : 置き換えた文字列の個数を格納する変数
            */

            // $str = 'abc-ab-add-acf-orabd';
            // print str_replace('ab', 'A', $str, $count) . '<br />';
            // print "{$count}個置き換え";

            // $array = ['musashi is good friend.', 'musashi is a cute cat.'];
            // $old = ['musashi', 'is'];
            // $new = ['Musashi', 'was'];
            // print_r(str_replace($old, $new, $array, $count));
            // print "{$count}箇所を置換";

            /*
                文字列を特定の区切りで分割
                explode(string $separator, string $string [, int $limit = PHP_INT_MAX]) : array
                $separator : 区切り文字
                $string : 分割する文字列
                $limit : 分割の最大数

                $limitに負の数を指定した場合、最後の$limit個(絶対値)を除く分割結果を返す
            */

            // $str = 'ttとrnとymとjk';
            // print_r(explode('と', $str)); // output ['tt','rn','ym','jk']
            // print_r(explode('や', $str)); // output ['ttとrnとymとjk']
            // print_r(explode('と', $str, 2)); // output ['tt','rnとymとjk']
            // print_r(explode('と', $str, -2)); // output ['tt','rn']

            /*
                特定の文字位置を検索する
                mb_strpos(string $haystack, string $needle[, int $offset [, ?string $encoding]]) : int|false
                mb_strrpos(string $haystack, string $needle[, int $offset [, ?string $encoding]]) : int|false

                $haystack : 検索対象の文字列
                $needle : 検索文字列
                $offset : 検索開始位置
                $encoding : 使用する文字列エンコーディング

                mb_strpos -> 検索対象が最初に現れた位置を返す
                mb_strrpos -> 検索対象が最後に現れた位置を返す
            */

            // $str = 'にわにはにわにわとりがいる';
            // print_r(mb_strpos($str, 'にわ')); // output 0
            // print_r(mb_strpos($str, 'にわ',2)); // output 4
            // print_r(mb_strpos($str, 'にわ', -10)); // output 4
            // print_r(mb_strrpos($str, 'にわ')); // output 6
            // print_r(mb_strrpos($str, 'にわ', -8)); // output 4

            /*
                部分文字列の登場回数をカウント
                mb_substr_count(string $haystack, string $needle, [,?string $encoding]): int
                $haystack : 検索対象の文字列
                $needle : 検索文字列
                $encoding : 使用する文字エンコーディング
            */

            // $str = 'にわにはにわにわとりがいる';
            // print_r(mb_substr_count($str, 'にわ'));
            // $str = 'にわにわにわにわ';
            // print_r(mb_substr_count($str, 'にわにわ')); // 重複しないようにカウントするためこの場合、3でなく2となる

            /*
                文字列に特定の文字が含まれるかを判定する(php 8.0)
                str_contains(string $haystack, string $needle):bool
                str_starts_with(string $haystack, string $needle):bool
                str_ends_with(string $haystack, string $needle):bool

                $haystack : 検索対象文字列
                $needle : 検索文字列
            */

            // $str = 'WINGSプロジェクト';
            // var_dump(str_contains($str, 'プロ'));
            // var_dump(str_starts_with($str, 'WINGS'));
            // var_dump(str_ends_with($str, 'プロジェクト'));

            /*
                文字列の前後から空白を除去する
                前後双方向の空白削除
                    trim(string $string[,string $characters = "\n\r\y\v\0"]):string
                前方だけの空白削除
                    ltrim(string $string[,string $characters = "\n\r\y\v\0"]):string
                後方だけの空白削除
                    rtrim(string $string[,string $characters = "\n\r\y\v\0"]):string

                $string : 対象の文字列
                $characters : 除去する文字

                $charactersに除去したい文字を列挙することで、任意の文字を除去できる
                文字列の前後から文字を取り除く用途に用いるため、文字列に含まれる文字まで除去する場合はstr_replaceを使う
            */

            // $str = "こんにちは\t\n\r";
            // var_dump($str);
            // var_dump(trim($str));

            /*
                文字列を整形
                printf(string $format, mixed ...$values): int
                sprintf(string $format, mixed ...$values): int
                $format : 書式文字列
                $values : 書式に埋め込む文字列

                指定された書式に基づいて文字を整形し、その結果を出力する
                出力せずに文字列を取得するだけならsprintfを使用する
                書式文字列には変換指定子(書式の中に値を埋め込むための記法)と呼ばれるプレイスホルダーを埋め込むことができる
            */

            // printf('%sは%sです', 'mu-', '猫');
            // printf('売り上げ平均（前月比）：%+0-8.3f', 0.198765);

            /*
                文字列を変換する
                mb_convert_kana(string $string[,string $mode = "KV"[,?string $encoding]]): string
                $string : 任意の文字列
                $mode : 変換オプション
                $encoding : 使用する文字エンコーディング
            */

            // $str = 'WINGSﾌﾟﾛｼﾞｪｸﾄ';
            // print $str;
            // print mb_convert_kana($str,'RKV');

            /*
                文字エンコーディングを変更
                mb_convert_encoding(string|array $string, string $to_encoding[,string|array|null $from_encoding]): string|array|false
                $string : 任意の文字列、またはその配列
                $to_encoding : 変換後の文字コード
                $from_encoding : 変換前の文字コード
            */

            /*
                電子メールを送信
                mb_send_mail(string $to, string $subject, string $message[,string|array $additional_headers[,?string $additional_params]]):bool
                $to : 宛先
                $subject : 件名
                $message : 本文
                $additional_header : メールヘッダー
                $additional_params : その他システムに渡すパラメータ情報
            */

        /* ************************************************** */

        /* 配列関数 */

        /* sample */

            /*
                配列の要素数を取得する
                count(array $value,[,int $mode = COUNT_NORMAL]):int
                $value : 体操の配列
                $mode : カウントの方法

                要素数ごとの登場回数をカウントする
                array_count_values(array $array): array
                $array: カウント対象の配列
                *カウントできるのは文字列か数値のみなので、それ以外の型の場合はエラーになる
            */

            // $data = ["a", "b", "c", "d", "e"];
            // print count($data);

            // $data2 = [
            //     ["a1", "b1", "c1", "d1", "e1"],
            //     ["a2", "b2", "c2", "d2", "e2"],
            //     ["a3", "b3", "c3", "d3", "e3"]
            // ];
            // print count($data2); // 多次元配列の場合、入れ子の配列の個数までカウントしないため3を返す
            // print count($data2, COUNT_RECURSIVE); // 入れ子の配列までカウントしたい場合は$modeをCOUNT_RECURSIVEに指定することで18を返す

            // $data = ["a", "b", "c", "d", "e", "a", "c"];
            // print_r(array_count_values($data)); // output [a] => 2 [b] => 1 [c] => 2 [d] => 1 [e] => 1

            /*
                配列の内容を連結
                array_merge(array ...$arrays):array
                $arrays : 連結する配列

                連想配列のキーが重複している場合は後者が優先される
                インデックス番号が重複している場合は新たな番号が振られ、上書きされない

                配列のキーが重複した時に上がくのではなく入れ子の配列にする場合はarray_merge_recursiveを使う
            */

            // $arr1 = [1,3,5];
            // $arr2 = [2,3,4];
            // print_r(array_merge($arr1, $arr2)); // output [0] => 1 [1] => 3 [2] => 5 [3] => 2 [4] => 3 [5] => 4

            // $assoc1 = ['Apple' => 'Red', 'Orange' => 'Yellow', 'Melon' => 'Green'];
            // $assoc2 = ['Grape' => 'Purple', 'Apple' => 'Green', 'Strawberry' => 'Red'];
            // print_r(array_merge($assoc1, $assoc2)); // output [Apple] => Green [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red
            // print_r(array_merge_recursive($assoc1,$assoc2)); // output  [Apple] => Array ( [0] => Red [1] => Green ) [Orange] => Yellow [Melon] => Green [Grape] => Purple [Strawberry] => Red

            /*
                配列の各要素を結合
                implode(string $separator, array $array): string
                $separator : 結合に使用する文字
                $array : 結合する配列
            */

            // $data = ['PHP', 'Ruby', 'Python', 'JavaScript'];
            // print implode('/', $data); // output "PHP/Ruby/Python/JavaScript"

            /*
                配列の先頭/末尾に要素を追加/削除
                    末尾に追加
                    array_push(array &$array, mixed ...$values): int
                    末尾から削除
                    array_pop(array &$array): mixed
                    先頭に追加
                    array_unshift(array &$array, mixed ...$values): int
                    先頭から除去
                    array_push(array &$array): mixed

                    &$array : 操作対象の配列
                    $values : 追加する要素

                    これらの関数は全て与えられた配列に直接影響を及ぼす
                    つまり引数&$arrayにはリテラルではなく必ず変数を指定しないといけない

                    配列の末尾に追加する場合、array_pushよりもブラケット構文を用いた方が関数を呼ぶオーバーヘッドがない分有利
                    オーバーヘッド :
                        その処理を行うのに必要となる負荷的、間接的な処理や手続きのこと
                        またはそのためにかかる負荷、余分に費やされる処理時間

                    stack :
                        後入れ先だし(LIFO / Last In First Out)、または先入後出し(FILO / First In Last Out)と呼ばれるデータの構造

                    queue :
                        先入れ先出し(FIFO / First In First Out)と呼ばれる構造のことで、待ち行列とも呼ばれる

            */

            // $data = ['a', 'b', 'c'];
            // print array_push($data, 'd');
            // print_r($data);

            // print array_pop($data);
            // print_r($data);

            // print array_unshift($data, 'z');
            // print_r($data);

            // print array_shift($data);
            // print_r($data);

            /*
                配列にゆく数要素を追加 / 置換 / 削除
                array_splice(array &$array, int $offset[,?int $length[,mixed $replacement]):array
                &$array : 操作対象の配列
                $offset : 抽出開始位置
                $length : 取り出す要素数
                $replacement : 削除した場所に挿入する配列、または文字列も可
            */

            // $data = ['a', 'b', 'c', 'd', 'e', 'f'];
            // print_r(array_splice($data, 3, 2));
            // print_r($data);

            // print_r(array_splice($data, -4, -1));
            // print_r($data);

            // print_r(array_splice($data, 4));
            // print_r($data);

            // print_r(array_splice($data, 1, 0, ['A','B']));
            // print_r($data);

            /*
                配列から特定範囲の要素を取得する
                array_slice(array $array, int $offset, [,?int $length[,bool $preserve_keys = false]]):array
                $array : 任意の配列
                $offset : 抽出開始位置
                $length : 取り出す要素数
                $preserve_keys : 取得した要素のキーを維持するか
            */

            // $data = ['a', 'b', 'c', 'd', 'e', 'f'];
            // print_r(array_slice($data, 2,2));
            // print_r(array_slice($data, 2, 3, true));
            // print_r(array_slice($data, 4));
            // print_r(array_slice($data, -5, -3));

            /*
                配列の内容を検索
                array_search(mixed $needle, array $haystack[,bool $strict = false]):int|string|false
                $needle : 検索すべき値
                $haystack : 検索対象の配列
                $strict : ===で比較するか
            */

            // $data = ['PHP', 'JavaScript', 'PHP', 'Java', 'C#', '15'];
            // $data2 = ['X' => 10, 'Y' => 20, 'Z' => 30];

            // var_dump(array_search('JavaScript', $data));
            // var_dump(array_search('PHP', $data)); // 同じ値がある場合、最初に見つかったもののキーが返される
            // var_dump(array_search('JAVA', $data)); // 大文字と小文字を区別するためfalseが買える
            // var_dump(array_search(15, $data)); // 文字列と数値の比較でも一致とみなす
            // var_dump(array_search(15, $data, true)); // strictをtrueにすると===で比較するのでfalseとなる
            // var_dump(array_search(10, $data2)); // 連想配列でも検索可能。戻り値はキーとなる

            /*
                配列内に特定の要素が存在するかを確認
                in_array(mixed $needle, array $haystack[,bool $strick = false]):bool
                $needle : 検索すべき値
                $haystack : 検索対象の配列
                $strict : ===演算子で比較するか

                単純に有無を調べる場合はarray_searchよりもin_arrayを使う方が良い
            */

            // $array = ['PHP', 'JavaScript', 'PHP', 'Java', 'C#', '15'];
            // var_dump(in_array('JavaScript', $array));

            /*
                配列の内容を並べ替える
                sort(array &$array,[,int $flags = SORT_REGULAR]):bool
                &$array : ソート対象の配列
                $flags : 比較の方法
            */

            // $data = ['tennis', 'swimming', 'soccer', 'baseball'];
            // sort($data, SORT_STRING);
            // print_r($data);
            // rsort($data, SORT_STRING);
            // print_r($data);

            // $data2 = ['tennis' => 1, 'swimming' => 1, 'soccer' => 11, 'baseball' => 9];
            // sort($data2, SORT_NUMERIC);
            // print_r($data2);

            // $data3 = ['tennis' => 1, 'swimming' => 1, 'soccer' => 11, 'baseball' => 9];
            // asort($data3, SORT_NUMERIC);
            // print_r($data3);
            // ksort($data3, SORT_NUMERIC);
            // print_r($data3);

            /*
                自作のルールで配列を並べる
                usort(array &$array, callable $callback): bool
                &$array : ソート対象の配列
                $callback : ソート規則を表した関数
            */

            // $keys = ['社員', '係長', '課長', '部長', '専務'];
            // $data = ['部長', '専務', '課長','社員'];
            // usort($data, function($a, $b) use($keys){
            //     return array_search($a,$keys)<=>array_search($b,$keys);
            // });
            // print_r($data);


            /*
                配列の内容を順に処理する
                array_walk(array &$array, callable $callback[,mixed $userdata]): bool
                &$array : 処理対象の配列
                $callback : 処理方法を表した関数
                $userdata : 引数$callbackに渡す任意の値
            */

            // $data = ['tt' => 'male', 'mk' => 'female', 'mu-' => 'male'];
            // array_walk($data,
            //     function($value, $key, $suffix){
            //         print "{$key} : {$value}{$suffix}";
            //     },'<br />');

            // $data = ['tt', 'mk', 'mu-'];
            // array_walk($data,
            //     function(&$value, $suffix){
            //         $value .= ':NEW';
            //     });
            // print_r($data);

            // 入れ子の配列を再帰的に処理する例
            // $sum = 0;
            // $count = 0;
            // $data = [5, 1, [10, -3]];
            // array_walk_recursive($data, function($value) use(&$sum, &$count){
            //     $sum += $value;
            //     $count++;
            // });
            // $average = $sum / $count;
            // print $count;
            // print $sum;
            // print $average;

            /*
                配列内の要素を加工する
                array_map(callable $callback, array $array, array ...$arrays):array
                $callback : 配列を加工するための関数
                $array / $arrays : 加工対象の配列
            */

            // $arr = [1,2,3];
            // $arr2 = [4,5,6];
            // print_r(array_map(function($value){return $value **= 2;}, $arr));
            // print_r(array_map(function($value1, $value2){return $value1 *$value2;}, $arr, $arr2));
            // print_r(array_map(null, $arr, $arr2));

            // foreachとの組み合わせ
            // $name = ['tt','mk','mu-'];
            // $age = [30, 29, 21];
            // foreach(array_map(null, $name, $age) as [$n, $a]){
            //     print "{$n} : {$a} <br />";
            // }

            /*
                配列の内容を特定の条件で絞り込む
                array_filter(array $array[,?callable $callback[,int $mode]]):array
                $array : 元の配列
                $callback : 要素のtrue/falseを判定する処理
                $mode : 動作オプション(省略した場合は、値のみを引数として渡す)
            */

            // $array = [1,2,3,4,5,6,7,8,9,10];
            // print_r(array_filter($array, function($v){return $v % 2 === 0;}));

            /*
                配列内の要素を順に処理して一つにまとめる
                array_reduce(array $array, callable $callback[,mixed $initial]):mixed
                $array : 処理対象の配列
                $callback : 要素を演算する処理
                $initial : 初期値
            */

            // $data = [2, 4, 6, 8];
            // $multi = array_reduce($data, function($result, $x){
            //     return $result * $x;
            // }, 1);
            // print $multi;

        /* ************************************************** */

        /*　正規表現(PCRE)関数
            正規表現:
                曖昧な文字パターンを表現するための記法
                散文的なデータを有る提携的な形式に沿って抽出し、データとしての洗練度を向上させる人間のためのデータとシステムのためのデータを繋ぐ橋渡し的な役割と入れる

            正規表現パターン :
                正規表現によって表されたある文字列パターン

            PHPでの正規表現パターン
                / pattern / opt
                pattern : 正規表現パターン
                opts : 修飾子

            注意事項 :
                正規表現パターンはシングルクォートで括る

            サブマッチパターン(キャプチャグループ) :
                正規表現パターンの中で()に囲まれた部分的なパターンのこと
                サブマッチパターンにマッチした文字列をサブマッチ文字列という。

            修飾子 :
                正規表現でマッチングや痴漢を行う際に利用する動作オプション
                    i : 大文字小文字の区別を無視
                    m : 複数行検索に対応
                    s : [.]が行末文字を含む任意の文字にマッチ
                    x : コメントの有効化
                    u : 正規表現パターンをUTF-8文字列として扱う

                修飾子は /~/im のように複数同時指定もできる

            最長一致 :
                正規表現で*や+などの量指定子を利用した場合に、できるだけ長い文字列を一致させない、というルール
                逆に最短一致はできるだけ短い文字列を一致させようとする

            名前つきキャプチャグループ :
                正規表現パターンに含まれる(...)でくくられたキャプチャグループに意味のある名前を付与したもの

            グループの後方参照 :
                グループにマッチした文字列を正規表現パターンの中で後から参照する機能
        */

        /* sample */

            /*
                正規表現で文字列を検索する
                preg_match(string $pattern, string $subject[,array &$matches[,int $flags [,int $offset]]]):int|false
                $pattern : 正規表現パターン
                $subject : 検索対象文字列
                &$matches : 検索結果を格納する配列
                $flags : 動作フラグ
                $offset : 検索の開始位置

                戻り値は正規表現パターンがマッチした回数を表す
                preg_match関数は最初の一回しかマッチング処理を行わない
            */

            // $str = '彼の電話番号は0399-88-9785、私のは0398-99-1234です。郵便番号はどちらも687-1109です。';
            // if(preg_match('/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/',$str, $data, PREG_OFFSET_CAPTURE)){
            //     print_r($data);
            // }

            /*
                全てのマッチ文字列を取得
                preg_match_all(string $string, $subject[,array &$matches[,int $flags = PREG_PATTERN_ORDER[,int $offset]]]):int|false
            */

            // $str = '彼の電話番号は0399-88-9785、私のは0398-99-1234です。郵便番号はどちらも687-1109です。';
            // if(preg_match_all('/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/', $str, $data, PREG_SET_ORDER)){
            //     foreach($data as $item){
            //         print "{$item[0]}<br />";
            //         print "{$item[1]}<br />";
            //         print "{$item[2]}<br />";
            //         print "{$item[3]}<hr />";

            //     }
            // }

            /*
                正規表現で文字列を置換する
                preg_replace(string|array $pattern, string|array $replacement, string|array $subject[,int $limit = 1[,int &$count]]): string|array|null
            */

            // $msg = <<<EOD
            // サンプルは、http://www.wings.msn,to/から入手できます。
            // 執筆のノウハウ集もどうぞhttp://www31.atwiki.jp/wingsproject
            // もどうぞ。
            // EOD;

            // print preg_replace('|http.*|','<a href="$0">$0</a>',$msg);

            /*
                正規表現で置き換えたコールバック関数で処理する
                preg_replace_callback(string|array $pattern, callable $callback, string|array $subject[,int $limit = -1[,int &$count[,int $flags]]]):string|array|null
            */

            // $msg = <<<EOD
            // サンプルは(http://www.wings.msn.to/)から入手できます。
            // こちら(http://www31.atwiki.jp/wingsproject)もどうぞ
            // EOD;

            // print preg_replace_callback(
            //     '|http(s)?://([\w-]+\.)+[\w-]+(\[\w ./?%&=-]*)?|i',
            //     function($matches){
            //         foreach($matches as $match){
            //             return mb_convert_case($match, MB_CASE_UPPER);
            //         }
            //     },
            //     $msg
            // );

            /*
                正規表現で文字列を分割する
                preg_split(string $pattern, string $subject[,int $limit = -1[,int $flags]]):array|false
            */

            // $today = '2021-08-30';
            // $result = preg_split('|[/.\-]|', $today);
            // print "{$result[0]}年{$result[1]}月{$result[2]}日";


        /* ************************************************** */

        /* **************************************************
            ユーザー定義関数
        ************************************************** */

        /*
            ユーザー定義関数 :
                自身で定義した関数

            構文 :
                function 関数名(仮引数, ...){
                    処理
                    return 戻り値;
                }

            関数名の命名規則は変数と同じ
            動詞+名詞の形で命名するのが慣例的

            引数 :
                メソッドの中で参照可能な変数
                呼び出し元から渡される値を実引数、受け取り側の変数を仮引数と呼ぶ場合もある
                引数の個数はドキュメント上明記されていないが、あまりに多い場合は連想配列やクラスとしてまとめるのが良い
                引数の名前は、関数名と同じく意味のわかりやすい名前にすべき
                引数は重要なものから順に並べる、また関連する情報は隣接するように並べるように意識する
                また、似たような引数を取る関数を定義する場合、変数の順序に一貫性を持たせる

            戻り値(返り値) :
                関数が処理した結果で、return命令によって表す
                return命令は関数の途中でも記載できるが、return以降の命令は実行されないので、
                一般的には関数の末尾や条件分岐とセットで利用する
                戻り値がない場合はreturnを省略できるが、その場合nullを返したとみなす
                return命令は関数の処理を中断するためにも利用でき、その場合はreturn;のみ記述することで戻り値を返さずただ処理を終了するという意味になる

            型宣言 :
                引数や戻り値に明示的に型を指定すること

            複合的な型宣言

                null許容型 :
                    型の先頭に?を付与することでnullを許容することを表現できる
                    ex) function exp(?int $value): void { do something }
                    ただし、null許容型はnullを許容するだけであり、valueそのものを省略するとエラーになる点に注意

                Union型(PHP8.0) :
                    |で区切り複数の方のどちらかを許容するように型宣言ができる
                    なお冗長な型はエラーとして検出される（object|Classなど）

                false擬似型 :
                    Union型でのみ利用できる型で「int|false」のように用いる

            void :
                戻り値としてのみ利用できる型で、何も返さないことを表現する
                voidを利用する場合、return nullはエラーとなるので、何も返さないかreturn;と記述する

        */

        /* sample */

            // function diamond(float $diagonal1, float $diagonal2): float {
            //     return $diagonal1 * $diagonal2 / 2;
            // }
            // print diamond(4, 5);

        /* ************************************************** */

        /* 変数のスコープ
            スコープ :
                変数の有効範囲
            グローバルスコープ :
                スクリプト全体から参照できるスコープ
            ローカルスコープ :
                定義された関数の中でのみ参照できるスコープ
            グローバル変数 :
                グローバルスコープを持つ変数
            ローカル変数 :
                ローカルスコープを持つ変数

            静的変数 :
                関数の実行後もローカル変数を維持するための概念

            requireなどによって読み込まれたファイルのスコープは読み込み元のスコープによって変動する
            関数内で読み込んだ場合はローカルスコープになり、関数の外で読み込むとグローバルスコープになる
        */

        /* sample */
            // スコープ外のためエラーになる場合
                // $x = 10;
                // function example(): int {
                //     return ++$x;
                // }
                // print example();
                // print $x;
            // globalを使って強制的にグローバル変数にローカル変数を割り当てた場合、エラーにならない
                // $x = 10;
                // function example(): int {
                //     global $x;
                //     return ++$x;
                // }
                // print example();
                // print $x;
            // 静的変数を利用してローカル変数の値がカウントアップされる例
                // function example(): int {
                //     static $x = 0;
                //     return ++$x;
                // }
                // print example();
                // print example();

        /* ************************************************** */

        /* 引数の記法
            引数の既定値
                = を利用することで仮引数に既定値を使用できる
                既定値は引数を省略した場合に設定される値
                また、必須の変数の前に既定値の引数を指定してはいけない

            引数の参照わたし
                引数は値渡しされるのが基本
                しかし仮引数の頭に&を付与すると参照渡し隣、実引数を操作することができる
                ただし、参照渡しされた引数を関数の中で破棄しても元々の変数に影響しない

            名前つき引数(PHP8.0)
                関数の呼び出し時に名前を明示的に指定できる引数
                標準ライブラリでも利用でき、公式ドキュメントから引数の名前を確認できる

            可変長引数
                引数の個数があらかじめ決まっていない関数（0個以上の引数を表す）
                仮引数の直前に...を付与することで、任意の個数を配列としてまとめて取得できる
                可変長引数は通常の引数と同じく型宣言ができる
                可変長引数は通常の引数と同居させることができるが、可変長引数は必ず引数リストの末尾に置かなければならない

            ...演算子による引数のアンパック
                ...演算子は日引数で利用することで配列を個々の値に展開（アンパック）できる

        */

        /* sample */
            // 引数だけを省略する例
                // function getTriangleArea($base = 5, $height = 2){
                //     return $base * $height / 2;
                // }

                // print getTriangleArea();
                // print getTriangleArea(20); // 引数$baseだけを省略することはできない、あくまで後ろの引数だけ
                // print getTriangleArea(10, 10);

            // 必須の引数の前に既定値の変数を使ったエラー
                // function getTriangleArea($base = 5, $height){
                //     return $base * $height / 2;
                // }

                // print getTriangleArea(20); // ArgumentCountError

            // 引数の参照渡し
                // function increment(&$value) {
                //     return ++$value;
                // }
                // $num = 10;
                // print increment($num);
                // print $num;

            // 名前つき引数
                // function getTriangleArea($base = 5, $height = 2){
                //     return $base * $height / 2;
                // }

                // print getTriangleArea(height: 4); // $baseを省略し、$heightにのみ値を入れられる

            // 可変長引数
                // function total(int ...$values): int{
                //     $result = 0;
                //     foreach($values as $value){
                //         $result += $value;
                //     }
                //     return $result;
                // }
                // print total(1,3,4,8);
                // print total(1,3,4,6,7,8,8);

            // 引数のアンパック
                // function getTriangleArea($base, $height){
                //     return $base * $height / 2;
                // }

                // print getTriangleArea([4, 5]); // ng
                // print getTriangleArea(...[4, 5]); // ok

        /* ************************************************** */

        /* 関数の呼び出しと戻り値
            複数の戻り値を返す場合
                配列として値を一つにして戻す

            再帰関数 :
                ある関数が自分自身を呼び出すことや、そのような関数のこと

            可変関数 :
                $変数名()の形式で呼び出せる関数
                同的に関数を振り分けることができる

            高階関数 :
                引数として関数そのものを渡したり、戻り値として関数を返すための関数

            コールバック関数 :
                呼び出し先の関数の中で呼び出される関数

            無名関数(クロージャー) :
                関数名がなく、特定の機能だけを一度だけ利用する場合に用いられる
                function(仮引数){
                    処理
                    return 戻り値
                }
                また、無名関数は変数に代入することもできる

            use命令 :
                親スコープから変数を引き継ぐために使用する
                ,区切りで複数の変数を引き継ぐこともできる

            アロー関数(PHP7.4) :
                無名関数をシンプルに書くための構文
                fn(仮引数) => 任意の式
                親スコープの変数を暗黙的に利用できる
                ただし、アロー関数では単一の式しか書けない
                また、必ず値渡しとなってしまうので、参照渡しできない

        */

        /* sample */
            // 複数の戻り値を返す
                // function max_min(...$args) {
                //     return [max($args), min($args)]; // 配列で返すことで複数の値を同時に返すことができる
                // }

                // [$max, $min] = max_min(1,2,3,4,5,6,7,8,9); // 分割代入で戻り値を同時に代入することもできる
                // print $max . ' / ' . $min;

            // 再帰関数の例
                // function factorial($num){
                //     if($num){
                //         return $num * factorial($num -1);
                //     }
                //     return 1;
                // }

                // print factorial(5);

            // 可変関数
                // function getTriangle($base, $height){
                //     return $base * $height / 2;
                // }

                // $name = 'getTriangle';
                // $area = $name(4, 5);
                // print $area;

            // 高階関数の実装例
                // function originArr($array, $func){
                //     foreach($array as $key => $item){
                //         $func($key, $item);
                //     }
                // }

                // function printOrigin($key, $item){
                //     print "{$key}:{$item}";
                // }

                // $array = ['A','B','C','D'];
                // originArr($array, 'printOrigin');

            // 無名関数を利用した高階関数
                // function originArr($array, $func){
                //     foreach($array as $key => $item){
                //         $func($key, $item);
                //     }
                // }

                // $array = ['A','B','C','D'];
                // originArr($array, function ($key, $item){
                //     print "{$key}:{$item}";
                // });

            // use命令
                // $x = 10;
                // function totalA($args, $callable){
                //     $result = 0;
                //     foreach($args as $arg){
                //         $result += $arg;
                //     }
                //     return $callable($result);
                // }
                // print totalA([1,2,3],function($value)use($x){return $value * $x; });

            // アロー関数
                // $x = 10;
                // function totalA($args, $callable){
                //     $result = 0;
                //     foreach($args as $arg){
                //         $result += $arg;
                //     }
                //     return $callable($result);
                // }
                // print totalA([1,2,3,4],fn($value) => $value * $x);

        /* ************************************************** */

        /* ジェネレーター
            ジェネレーター :
                yield命令を使うことで、その時々の値を返すことができる
            yield :
                returnと異なり、その時点で関数を終了するのではなく、次に呼び出されたときに続きから処理を再開する
        */

        /* ************************************************** */



        /* ************************************************** */
        /* ************************************************** */
        /* ************************************************** */
        /* ************************************************** */

        return Inertia::render('Welcome2', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'value' => 'sample'
        ]);
    }
}
