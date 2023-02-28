<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Categories extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        'image',
        'desc',
        'slug'
    ];

    protected static $depth = 0;

    public static function getTree()
    {
        $categories = self::all();
        $lists = '<ul>';
        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $lists .= self::renderNode($category);
            }
        }
        $lists .= "</ul>";
        return $lists;
    }
    public static function renderNode($node)
    {
        $list = '<li><a href="/admin/categories/' . $node->id . '/edit"  class="btn btn-primary">' . $node->name . '</a>
                <a href="/assets/files/categories/'.$node->file.'" class="btn btn-sm" target="_black">'.$node->file.'</a>
             </li><br />';
        $children = self::where('parent_id', '=', $node->id)->get();
        $count = $children->count();
        if ($count > 0) {
            $list .= '<ul>';
            foreach ($children as $child) {
                $list .= self::renderNode($child);
            }
            $list .= "</ul><hr>";

        }
        return $list;
    }

    public static function getList()
    {
        $categories = self::all();
        $lists = '';
        foreach ($categories as $category) {
            if ($category->parent_id === null) {
                $lists .= self::renderOption($category);
            }
        }
        return $lists;
    }

    public static function renderOption($node)
    {
        $list = '<option value="' . $node->id . '">' . self::dash(self::$depth) . ' '.$node->name . '</option>';
        $children = self::where('parent_id', '=', $node->id)->get();
        $count = $children->count();
        if ($count > 0) {
            self::$depth++;
            foreach ($children as $child) {
                $list .= self::renderOption($child);
            }
            self::$depth--;
        }
        return $list;
    }

    private static function dash($depth)
    {
        $dash = '';
        for ($i = 1; $i <= $depth; $i++) {
            $dash .= ' - ';
        }
        return $dash;
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'cat_id');
    }

    public static function getTreeHP() {
        $categories = self::get()->toTree();
        $lists = '<div class="dropdown">';
        foreach($categories as $category)
            $lists .= self::renderNodeHP($category);
        $lists .= "</div>";
        return $lists;
    }


    public static function renderNodeHP($node) {
        $list = '<div class="dropdown" aria-labelledby="'.$node->id.'"><a class="dropdown-item" id="'.$node->id.'" role="button"
                                   aria-expanded="false" href="/categories/'.$node->slug.'">'.$node->name.'</a>';
        if ( $node->children()->count() > 0 ) {
            $list .= '<div class="dropdown-menu" style="margin-left: 100px; min-width: 300px;" >';
            foreach($node->children as $child)
                $list .= self::renderNodeHP($child);
            $list .= "</div>";
        }

        $list .= "</div>";
        return $list;
    }

    public static function getTreeMobile()
    {
        $categories = self::all();
        $lists = '';
        $linkId = '';
        $sub = '';

        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $linkId = '';

                $lists .= self::renderNodeMobile($category, $linkId);
            }
        }
        return $lists;
    }

    public static function renderNodeMobile($node, $linkId)
    {
        if (count($node->children) > 0)
        {
            $linkId =  'class="menu-item-has-children"';
        }

        $list = '<li '.$linkId.'>
                    <a '. $linkId .' href="/#filters" data-filter-id="'.$node->id.'" aria-haspopup="true" aria-expanded="false">
                               ' . $node->name . '
                            </a>';

        if (count($node->children)) {
            $noSub = '';
            $linkId = '';

            $list .= '<ul class="sub-menu-mobile">';
            foreach ($node->children as $child) {
                $list .= self::renderNodeMobile($child, $linkId);
            }
            $list .= '</li></ul>';
        }
        return $list;
    }

    public static function renderGallery()
    {
        $categories = self::all();
        $lists = '';
        $linkId = '';
        $sub = '';

        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $linkId = '';

                $lists .= self::renderNodeGallery($category, $linkId);
            }
        }
        return $lists;
    }

    public static function renderNodeGallery($node, $linkId)
    {
        if (count($node->children) > 0)
        {
            $linkId =  'class="menu-item-has-children"';
        }

        $list = '<li '.$linkId.'>
                    <a '. $linkId .' href="/'.$node->slug.'#photos" data-filter-id="'.$node->id.'" aria-haspopup="true" aria-expanded="false">
                               ' . $node->name . '
                            </a>';

        if (count($node->children)) {
            $noSub = '';
            $linkId = '';

            $list .= '<ul class="sub-menu-mobile">';
            foreach ($node->children as $child) {
                $list .= self::renderNodeGallery($child, $linkId);
            }
            $list .= '</li></ul>';
        }
        return $list;
    }


    public static function getGalleryMobile()
    {
        $categories = self::all();
        $lists = '';
        $linkId = '';
        $sub = '';

        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $linkId = '';

                $lists .= self::renderGalleryMobile($category, $linkId);
            }
        }
        return $lists;
    }

    public static function renderGalleryMobile($node, $linkId)
    {
        if (count($node->children) > 0)
        {
            $linkId =  'class="menu-item-has-children"';
        }

        $list = '<li '.$linkId.'>
                    <a '. $linkId .' href="'.$node->slug.'#filters" data-filter-id="'.$node->id.'" aria-haspopup="true" aria-expanded="false">
                               ' . $node->name . '
                            </a>';

        if (count($node->children)) {
            $noSub = '';
            $linkId = '';

            $list .= '<ul class="sub-menu-mobile">';
            foreach ($node->children as $child) {
                $list .= self::renderGalleryMobile($child, $linkId);
            }
            $list .= '</li></ul>';
        }
        return $list;
    }

    public function hasChild() {
        return self::where('parent_id', '=', $this->id)->get()->count() ? true : false;
    }

//    public function products()
//    {
//        return $this->hasMany(Product::class, 'category');
//    }

}
