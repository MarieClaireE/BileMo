# AuthentificationApi

All URIs are relative to *http://api.bilemo.com/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**loginCheckPost**](AuthentificationApi.md#loginCheckPost) | **POST** /login_check | Retourne le token JWT pour l&#39;authentification sur les routes.


<a name="loginCheckPost"></a>
# **loginCheckPost**
> Token loginCheckPost(credential)

Retourne le token JWT pour l&#39;authentification sur les routes.

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.AuthentificationApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");

    AuthentificationApi apiInstance = new AuthentificationApi(defaultClient);
    Credential credential = new Credential(); // Credential | Génération d'un nouveau token JWT
    try {
      Token result = apiInstance.loginCheckPost(credential);
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling AuthentificationApi#loginCheckPost");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credential** | [**Credential**](Credential.md)| Génération d&#39;un nouveau token JWT | [optional]

### Return type

[**Token**](Token.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | JWT Token obtenu |  -  |

