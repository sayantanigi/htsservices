<table id="dataTable333" class="table dt-responsive nowrap w-100">
    <thead>
       <tr>
          <th width="70">#</th>
          <th>Image</th>
          <th>Actions</th>
       </tr>
    </thead>


    <tbody id="listingHTML">
       @if(!$data['listing_gallery']->isEmpty())
          @foreach($data['listing_gallery'] as $key=>$row)
         
             <tr>
                <td>{{ $key+1 }}</td>
                <td>
                   @if(@$row->filename && file_exists( 'public/uploads/files/'.@$row->filename))
                     @php
                         $ext = pathinfo(asset('/uploads/files/'.@$row->filename), PATHINFO_EXTENSION);
                     @endphp
                        @if ($ext=="jpeg" || $ext=="jpg" || $ext=="png" || $ext=="gif")
                           <img id="output_image" src="{{ asset('/uploads/files/'.@$row->filename) }}" alt="image">
                        @else
                           <a href="{{ asset('/uploads/files/'.@$row->filename) }}" target="__blank">{{ @$row->filename }}</a>
                        @endif
                   @else
                      <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                   @endif
                </td>
                <td>
                   <button class="btn btn-xs btn-danger" onclick="deleteHtsListingImage({{@$row->id}})"><i class="fas fa-trash-alt"></i></button>
                </td>
             </tr>
          @endforeach
       @endif
    </tbody>
 </table>