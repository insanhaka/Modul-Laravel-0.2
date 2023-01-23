import React, { useEffect, useState } from 'react';
import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { InputText } from 'primereact/inputtext';
import { FilterMatchMode } from 'primereact/api';
import { Message } from 'primereact/message';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Button } from 'primereact/button';
import { Dialog } from 'primereact/dialog';
import Backdrop from '@mui/material/Backdrop';
import LoadingIMG from '../../../../public/assets/img/loading.gif'

// Data
import UserData from '../../dataservice/Usersdata';

function Usertable() {

    const data = UserData();
    const [loading, setLoading] = useState(false);
    const handleClose = () => {
        setLoading(false);
    };
    const [userON, setUserON] = useState(false);
    const [userOFF, setUserOFF] = useState(false);

    // TABEL
    const [globalFilterValue, setGlobalFilterValue] = useState('');
    const [filters, setFilters] = useState({
        'global': { value: null, matchMode: FilterMatchMode.CONTAINS },
        'name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        'email': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    });
    const onGlobalFilterChange = (e) => {
        const value = e.target.value;
        let _filters = { ...filters };
        _filters['global'].value = value;

        setFilters(_filters);
        setGlobalFilterValue(value);
    }
    const renderHeader = () => {
        return (
            <div className="row">
                <span className="p-input-icon-right">
                    <i className="pi pi-search" style={{ marginRight: 20 }} />
                    <InputText value={globalFilterValue} onChange={onGlobalFilterChange} placeholder="Cari Disini" style={{ float: 'right', height: 30, width: 210 }} />
                </span>
            </div>
        )
    }
    const renderEmpty = () => {
        return (
            <center>
                <Message severity="error" text="Oppsss.. Data tidak ditemukan" style={{ color: '#303952', backgroundColor: '#f1f2f6', width: '100%', marginTop: 20, marginBottom: 20 }} />
            </center>
        )
    }
    const header = renderHeader();
    const empty = renderEmpty();

    const activationTemplate = (rowData) => {
        if (rowData.is_active === 1) {
            return <div>
                    <Button label="AKTIF" className="p-button-success" aria-label="ON" style={{height: 30, fontSize: 11}} onClick={() => setUserOFF(true)}/>
                        <Dialog showHeader={false} visible={userOFF} onHide={() => setUserOFF(false)} breakpoints={{'960px': '75vw'}} style={{width: '30vw'}} >
                            <p className='text-center mt-6'>Apakah kamu yakin ingin menonaktifkan akun ini?</p>
                            <div className='row justify-content-center'>
                                <div className='col-2 mr-4'>
                                    <Button className="p-button-secondary p-button-text p-button-raised p-button-sm" onClick={() => setUserOFF(false)} style={{fontWeight: 'bold'}}>
                                        Tidak
                                    </Button>
                                </div>
                                <div className='col-2 ml-4'>
                                    <Button id={rowData.id} value={0} className="p-button-primary p-button-text p-button-raised p-button-sm" onClick={userActivation} style={{fontWeight: 'bold'}}>
                                        Ya
                                    </Button>
                                </div>
                            </div>
                        </Dialog>
                </div>
        }else {
            return <div>
                    <Button label="NON AKTIF" className="p-button-secondary" aria-label="OFF" style={{height: 30, fontSize: 11}} onClick={() => setUserON(true)}/>
                    <Dialog showHeader={false} visible={userON} onHide={() => setUserON(false)} breakpoints={{'960px': '75vw'}} style={{width: '30vw'}} >
                        <p className='text-center mt-6'>Apakah kamu yakin ingin mengaktifkan akun ini?</p>
                        <div className='row justify-content-center'>
                            <div className='col-2 mr-4'>
                                <Button className="p-button-secondary p-button-text p-button-raised p-button-sm" onClick={() => setUserON(false)} style={{fontWeight: 'bold'}}>
                                    Tidak
                                </Button>
                            </div>
                            <div className='col-2 ml-4'>
                                <Button id={rowData.id} value={1} className="p-button-primary p-button-text p-button-raised p-button-sm" onClick={userActivation} style={{fontWeight: 'bold'}}>
                                    Ya
                                </Button>
                            </div>
                        </div>
                    </Dialog>
            </div>
        }
    }
    const roleTemplate = (rowData) => {
        const listRole = rowData.roles.map((data) =>
            <div className="d-flex align-items-center lh-1 me-3 p-1" key={data.id} style={{color: data.color, fontWeight: 'bold'}}>
                <span className="badge badge-dot mr-2" style={{backgroundColor: data.color}}>-</span>
                {data.name}
            </div>
        );
        return listRole
    }
    const settingTemplate = (rowData) => {
        return  <div>
                    <Button id={rowData.id} onClick={userEdit} className="p-button-raised p-button-rounded p-button-text p-button-warning mr-2" aria-label="Ubah"><i className="pi pi-file-edit" id={rowData.id} onClick={userEdit}/></Button>
                    <Button id={rowData.id} onClick={userDelete} className="p-button-raised p-button-rounded p-button-text p-button-danger mr-2" aria-label="Hapus"><i className="pi pi-trash" id={rowData.id} onClick={userDelete}/></Button>
                </div>
    }

    const userActivation = (e)=> {
        setLoading(true)
        axios.post('/api/user-activation', {
            id: e.target.id,
            data: e.target.value,
        })
        .then(function (response) {
            if (response.data.message === 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast.fire({
                    icon: 'success',
                    title: response.data.data
                })
                setUserOFF(false)
                setUserON(false)
                window.location.reload();
                
            }else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast.fire({
                    icon: 'error',
                    title: response.data.data
                })
                setUserOFF(false)
                setUserON(false)
                setLoading(false)
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    const userDelete = (e)=> {
        setLoading(true)
        axios.post('/api/user-delete', {
            id: e.target.id,
        })
        .then(function (response) {
            if (response.data.message === 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast.fire({
                    icon: 'success',
                    title: response.data.data
                })
                window.location.reload();
                
            }else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast.fire({
                    icon: 'error',
                    title: response.data.data
                })
                setLoading(false)
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    const userEdit = (e) => {
        window.location.replace('/super/user/'+e.target.id+'/edit');
    }

    return (
        <div>
            <DataTable value={data} header={header} stripedRows responsiveLayout="scroll" dataKey="id" filters={filters} globalFilterFields={['name', 'year']} emptyMessage={empty} paginator rows={10} >
                <Column field="name" header="Nama" sortable></Column>
                <Column field="email" header="Email" sortable></Column>
                <Column field="role" header="Role" body={roleTemplate}></Column>
                <Column field="is_active" header="Aktifasi" body={activationTemplate}></Column>
                <Column field="setting" header="Pengaturan" body={settingTemplate}></Column>
            </DataTable>

            <Backdrop
                sx={{ backgroundColor: 'rgba(255, 255, 255, 0.6)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={loading}
                onClick={handleClose}
            >
                {/* <CircularProgress color="inherit" /> */}
                <img src={LoadingIMG} alt="LOADING..." style={{width: 110}} />
            </Backdrop>
        </div>
    );
}

export default Usertable;

if (document.getElementById('user-table')) {
    ReactDOM.render(<Usertable />, document.getElementById('user-table'));
}